<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryStoreRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->categoryRepo = new CategoryRepository();
    }

    public function index(Request $request)
    {

        $sortType = empty($request->sort) ? '' : $request->sort;
        $sort = (strtolower($sortType) == 'desc') ? 'asc' : 'desc';

        $fields    = array('category_id', 'category_name', 'category_status', 'category_time_created', 'category_time_updated');

        foreach($fields as $field){
            $path[] = !empty($request->search) ? '?search=' . $request->search . '&field=' . $field . '&sort=' . $sort : '?field=' . $field . '&sort=' . $sort;
        }
        $categories = $this->categoryRepo->getPaginate(10, $request->search, $request->field, $sort);
        return view('admin.category.index', ['categories' => $categories, 'path' => $path, 'field' => $request->field, 'search' => $request->search, 'sort' => $request->sort]);

    }

    public function postIndex(Request $request){
        if(($request->btn_ac || $request->btn_dac) && !empty($request->checkbox)){
            $status = ($request->btn_ac) ? "1" : "0";
            foreach($request->checkbox as $id){
                if(!empty($id) && !$this->categoryRepo->checkId($id)){
                    $this->categoryRepo->update($id, array('category_status' => $status));
                }
            }
            return redirect()->route('admin.category.index')->with(['message' => 'Đã sửa dữ liệu vừa checkbox thành công']);
        }else{
            return redirect()->route('admin.category.index')->with(['message' => 'Vui lòng checkbox đừng troll tớ !']);
        }

    }

    public function getAdd()
    {
        return view('admin.category.add');
    }

    public function postAdd(CategoryStoreRequest $request)
    {
        if(!$this->categoryRepo->checkCategoryName($request->category_name)) {
            return redirect()->route('admin.category.getAdd')->withErrors(['email' => 'Category đã có trong CSDL'])->withInput();
        }
        $arrayData  = array(
            'category_name'         => $request->category_name,
            'category_status'       => $request->category_status,
            'category_time_created' => date('Y-m-d h:i:s'),
            'category_time_updated' => date('Y-m-d h:i:s'),
        );
        $category = $this->categoryRepo->store($arrayData);
        if($category){
            return redirect()->route('admin.category.index')->with(['message' => 'Đã thêm category thành công']);
        }
    }

    public function getEdit($id)
    {
        if(!$this->categoryRepo->checkId($id)){
            $edit = $this->categoryRepo->getById($id);
            $stringStatus = $this->getStringStatusPageEdit($edit->category_status);
            return view('admin.category.edit', ['edit' => $edit, 'stringStatus' => $stringStatus]);
        }
        return redirect()->route('admin.category.index');

    }

    public function postEdit(CategoryStoreRequest $request)
    {
        if(!$this->categoryRepo->checkId($request->id)){
            $arrayData  = array(
                'category_name'         => $request->category_name,
                'category_status'       => $request->category_status,
                'category_time_updated' => date('Y-m-d h:i:s'),
            );
            if($this->categoryRepo->update($request->id, $arrayData)){
                return redirect()->route('admin.category.index')->with(['message' => 'Đã sửa category thành công']);
            }
        }
        return redirect('admin.category.index')->with(['message' => 'Không tồn tại category']);
    }

    public function delete($id)
    {
        if(!$this->categoryRepo->checkId($id)){
            $this->categoryRepo->destroy($id);
            return redirect()->route('admin.category.index')->with(['message' => 'Đã xóa thành công']);
        }
        return redirect()->route('admin.category.index')->with(['message' => 'Không có User này']);
    }

    private function getStringStatusPageEdit($id){
        return ($id == 1) ? "<option value = '1' selected>Activate</option><option value = '0'>Deactive</option>" : "<option value = '1'>Activate</option><option value = '0' selected>Deactive</option>";
    }

    private function getStringStatusPageHome($id){
        return ($id == 1) ? "<span class='text-success'>Activated</span>" : "<span class='text-error'>Deactive</span>";
    }
}
