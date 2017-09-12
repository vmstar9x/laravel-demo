<?php
/**
 * Created by PhpStorm.
 * User: VMstar9x
 * Date: 9/5/2017
 * Time: 3:57 AM
 */
namespace App\Repositories;

use App\Models\Category;
use App\Models\User;

class CategoryRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new Category();
    }

    public function checkCategoryName($name)
    {
        $check = $this->model->where('category_name', $name)->first();
        if(!$check) {
            return TRUE;
        }
        return FALSE;
    }

    public function getPaginate($n, $key = '', $field = '', $sort='asc')
    {
        $query = $this->model;
        if ($key) {
            $query = $query->where('category_name', 'LIKE', '%' . $key . '%')
                ->orWhere('category_id', '=', $key);
        }
        if($field){
            $sort = ($sort == 'asc') ? 'desc' : 'asc';
            $query = $query->orderBy($field, $sort);
        }
        return $query->paginate($n);
    }

    public function checkId($id)
    {
        $check = $this->model->where('category_id', $id)->first();
        if(!$check) {
            return TRUE;
        }
        return FALSE;
    }

    public function update($id, array $inputs)
    {
        return $this->model->where('category_id', $id)->update($inputs);
    }
}