<?php
/**
 * Created by PhpStorm.
 * User: VMstar9x
 * Date: 9/12/2017
 * Time: 3:42 PM
 */
namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function index(Request $request)
    {
        $sortType = empty($request->sort) ? '' : $request->sort;
        $sort = (strtolower($sortType) == 'desc') ? 'asc' : 'desc';

        $fields    = array('user_id', 'username', 'status', 'product_time_created', 'product_time_updated');

        foreach($fields as $field){
            $path[] = !empty($request->search) ? '?search=' . $request->search . '&field=' . $field . '&sort=' . $sort : '?field=' . $field . '&sort=' . $sort;
        }
        $products = $this->userRepo->getPaginate(10, $request->search, $request->field, $sort);
        return view('admin.user.index', ['users' => $products, 'path' => $path, 'field' => $request->field, 'search' => $request->search, 'sort' => $request->sort]);

    }

    public function postIndex(Request $request){
        if(($request->btn_ac || $request->btn_dac) && !empty($request->checkbox)){
            $status = ($request->btn_ac) ? "1" : "0";
            foreach($request->checkbox as $id){
                if(!empty($id) && !$this->userRepo->checkId($id)){
                    $this->userRepo->update($id, array('status' => $status));
                }
            }
            return redirect()->route('admin.user.index')->with(['message' => 'Đã sửa dữ liệu vừa checkbox thành công']);
        }else{
            return redirect()->route('admin.user.index')->with(['message' => 'Vui lòng checkbox đừng troll tớ !']);
        }

    }

    public function getAdd()
    {
        return view('admin.user.add');
    }

    public function postAdd(UserStoreRequest $request)
    {
        if(!$this->userRepo->checkEmail($request->email)) {

            return redirect()->route('admin.user.getAdd')->withErrors(['email' => 'Email đã được đăng ký'])->withInput();

        }

        $img = $request->user_img;
        $fileName = $img->getClientOriginalName();
        $img->move('upload/user', $fileName);

        $arrayData  = array('username' => trim($request->username),
            'pass' => md5($request->pass),
            'status' => $request->status,
            'privilege' => '1',
            'user_img'  => $fileName,
            'user_email' => $request->email,
            'user_time_created' => date('Y-m-d h:i:s'),
            'user_time_updated' => date('Y-m-d h:i:s'),
        );

        if($this->userRepo->store($arrayData)){

            return redirect()->route('admin.user.index')->with(['message' => 'Đã thêm thành công']);

        }
    }

    public function getEdit($id)
    {
        if(!$this->userRepo->checkId($id)){

            $edit = $this->userRepo->getById($id);
            $stringStatus = $this->getStringStatusPageEdit($edit['status']);
            return view('admin.user.edit', ['edit' => $edit, 'stringStatus' => $stringStatus]);

        }

        return redirect()->route('admin.user.index');

    }

    public function postEdit(UserStoreRequest $request)
    {
        if(!$this->userRepo->checkId($request->id)){

            $arrayData  = array('username' => trim($request->username),
                'pass' => (!empty($request->pass)) ? md5($request->pass) : '',
                'status' => $request->status,
                'user_email' => $request->email,
                'user_time_updated' => date('Y-m-d h:i:s'),
            );

            if($this->userRepo->update($request->id, $arrayData)){
                return redirect()->route('admin.user.index')->with(['message' => 'Đã thêm thành công']);
            }

            return redirect()->route('admin.user.index')->with(['message' => 'Đã xảy ra lỗi khi sửa dữ liệu !']);
        }

        return redirect()->route('admin.user.index')->with(['message' => 'Không tồn tại username này']);
    }

    public function delete($id)
    {
        if(!$this->userRepo->checkId($id)){
            $this->userRepo->destroy($id);
            return redirect()->route('admin.user.index')->with(['message' => 'Đã xóa thành công']);
        }
        return redirect()->route('admin.user.index')->with(['message' => 'Không có User này']);
    }
    private function getStringStatusPageEdit($id){
        return ($id == 1) ? "<option value = '1' selected>Activate</option><option value = '0'>Deactive</option>" : "<option value = '1'>Activate</option><option value = '0' selected>Deactive</option>";
    }
}
