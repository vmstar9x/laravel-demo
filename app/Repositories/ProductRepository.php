<?php
/**
 * Created by PhpStorm.
 * User: VMstar9x
 * Date: 9/10/2017
 * Time: 4:32 PM
 */
namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Product();
    }

    public function getPaginate($n, $key = '', $field = '', $sort='asc')
    {
        //echo $field;

        $query = $this->model;
        if ($key) {
            $query = $query->where('product_name', 'LIKE', '%' . $key . '%')
                           ->orWhere('product_id', '=', $key);
        }
        if($field){
            $sort = ($sort == 'asc') ? 'desc' : 'asc';
            $query = $query->orderBy($field, $sort);
        }
        return $query->paginate($n);
    }

    public function checkId($id)
    {
        $check = $this->model->where('product_id', $id)->first();
        if(!$check) {
            return TRUE;
        }
        return FALSE;
    }

    public function lastId()
    {
        return $this->model->orderBy('product_id', 'desc')->first()['product_id'];
    }

    public function update($id, array $inputs)
    {
        return $this->model->where('product_id', $id)->update($inputs);
    }


}