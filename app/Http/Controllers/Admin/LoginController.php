<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = new UserRepository();
    }


    public function login(Request $request)
    {
        if($request->session()->get('username')) {
            return redirect()->route('admin.user.index');
        }
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $user = $this->userRepository->findUserByUsernamePassWord($request->username, $request->password);
        if ($user) {
            $request->session()->put('username', $user->username);
            $request->session()->put('user_id', $user->user_id);
            $request->session()->put('user_img', $user->user_img);
            if($request->url_continue){
                return redirect($request->url_continue);
            }
            return redirect()->route('admin.user.index');
        }else{
            return redirect()->route('admin.getLogin')->withInput()->withErrors(['username' => 'Nhập sai username hoặc password']);
        }

    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('admin.getLogin');
    }
}
