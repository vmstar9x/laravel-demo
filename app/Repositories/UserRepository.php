<?php
/**
 * Created by PhpStorm.
 * User: VMstar9x
 * Date: 9/5/2017
 * Time: 3:57 AM
 */
namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function getPaginate($n, $key = '', $field = '', $sort='asc')
    {
        $query = $this->model;
        if ($key) {
            $query = $query->where('username', 'LIKE', '%' . $key . '%')
                            ->orWhere('user_id', '=', $key)
                            ->orWhere('user_email', 'LIKE', '%' . $key . '%');
        }
        if($field){
            $sort = ($sort == 'asc') ? 'desc' : 'asc';
            $query = $query->orderBy($field, $sort);
        }
        return $query->paginate($n);
    }

    public function checkId($id)
    {
        $check = $this->model->where('user_id', $id)->first();
        if(!$check) {
            return TRUE;
        }
        return FALSE;
    }

    public function checkEmail($email)
    {
        $check = $this->model->where('user_email', $email)->first();
        if(!$check) {
            return TRUE;
        }
        return FALSE;
    }

    public function findUserByUsernamePassWord($username, $password)
    {
        return $this->model->where(array('username' => $username, 'pass' => md5($password), 'status' => '1'))->first();

    }
    public function update($id, array $inputs)
    {
        return $this->model->where('user_id', $id)->update($inputs);
    }

    public function convertStatusToString($id = ''){
        return ($id == 1) ? "Active" : "Deactive";
    }

}