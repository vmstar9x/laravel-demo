<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductStoreRequest;
use App\Repositories\ProductRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->productRepo = new ProductRepository();
        $this->ImageRepo = new ImageRepository();
    }

    public function index(Request $request)
    {
        $sortType = empty($request->sort) ? '' : $request->sort;
        $sort = (strtolower($sortType) == 'desc') ? 'asc' : 'desc';

        $fields    = array('product_id', 'product_name', 'product_status', 'product_time_created', 'product_time_updated');

        foreach($fields as $field){
            $path[] = !empty($request->search) ? '?search=' . $request->search . '&field=' . $field . '&sort=' . $sort : '?field=' . $field . '&sort=' . $sort;
        }
        $products = $this->productRepo->getPaginate(10, $request->search, $request->field, $sort);
        return view('admin.product.index', ['products' => $products, 'path' => $path, 'field' => $request->field, 'search' => $request->search, 'sort' => $request->sort]);

    }

    public function postIndex(Request $request){
        if(($request->btn_ac || $request->btn_dac) && !empty($request->checkbox)){
            $status = ($request->btn_ac) ? "1" : "0";
            foreach($request->checkbox as $id){
                if(!empty($id) && !$this->productRepo->checkId($id)){
                    $this->productRepo->update($id, array('product_status' => $status));
                }
            }
            return redirect()->route('admin.product.index')->with(['message' => 'Đã sửa dữ liệu vừa checkbox thành công']);
        }else{
            return redirect()->route('admin.product.index')->with(['message' => 'Vui lòng checkbox đừng troll tớ !']);
        }

    }

    public function getAdd()
    {
        return view('admin.product.add');
    }

    public function postAdd(ProductStoreRequest $request)
    {

        $arrayData  = array(
            'product_name'         => $request->product_name,
            'product_price'        => $request->product_price,
            'product_description'  => $request->product_description,
            'product_status'       => $request->product_status,
            'product_time_created' => date('Y-m-d h:i:s'),
            'product_time_updated' => date('Y-m-d h:i:s'),
        );

        if($this->productRepo->store($arrayData)){
            if(isset($request->product_img)){
                foreach($request->product_img as $img){
                    $fileName = $img->getClientOriginalName();
                    $img->move('upload/product', $fileName);

                    $this->ImageRepo->store(array('img_path' => $fileName, 'product_id' => $this->productRepo->lastId()));
                }
            }
            return redirect()->route('admin.product.index')->with(['message' => 'Đã thêm thành công']);
        }
    }

    public function getEdit($id)
    {
        if(!$this->productRepo->checkId($id)){

            $edit = $this->productRepo->getById($id);
            $images = $this->ImageRepo->getById($id);
            $stringStatus = $this->getStringStatusPageEdit($edit->product_status);
            return view('admin.product.edit', ['edit' => $edit, 'images' => $images, 'stringStatus' => $stringStatus]);

        }

        return redirect()->route('admin.user.index');

    }

    public function postEdit(ProductStoreRequest $request)
    {
        if(!$this->productRepo->checkId($request->id)){

            $arrayData  = array(
                'product_name'         => $request->product_name,
                'product_price'        => $request->product_price,
                'product_description'  => $request->product_description,
                'product_status'       => $request->product_status,
                'product_time_updated' => date('Y-m-d h:i:s'),
            );
            if($this->productRepo->update($request->id, $arrayData)){

                if(isset($request->checkdel)){
                    foreach($request->checkdel as $key => $id){
                        $fileDelete = 'upload/product/' . $this->ImageRepo->getByImage($id)['img_path'];
                        if(File::exists($fileDelete)) {
                            File::delete($fileDelete);
                        }
                        $this->ImageRepo->destroy($id);
                    }
                }

                if(isset($request->product_img)){
                    foreach($request->product_img as $img){
                        $fileName = $img->getClientOriginalName();
                        $img->move('upload/product', $fileName);

                        $this->ImageRepo->store(array('img_path' => $fileName, 'product_id' => $request->id));
                    }
                }

                return redirect()->route('admin.product.index')->with(['message' => 'Đã sửa thành công']);
            }
        }
    }

    public function delete($id)
    {
        if(!$this->productRepo->checkId($id)){
            $this->productRepo->destroy($id);
            $this->ImageRepo->destroyProductID($id);
            return redirect()->route('admin.product.index')->with(['message' => 'Đã xóa product thành công!']);
        }
        return redirect()->route('admin.product.index')->with(['message' => 'Không có product này đừng troll tớ nhé !']);
    }

    private function getStringStatusPageEdit($id){
        return ($id == 1) ? "<option value = '1' selected>Activate</option><option value = '0'>Deactive</option>" : "<option value = '1'>Activate</option><option value = '0' selected>Deactive</option>";
    }

}
