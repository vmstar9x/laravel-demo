<?php
/**
 * Created by PhpStorm.
 * User: VMstar9x
 * Date: 9/11/2017
 * Time: 5:33 PM
 */
namespace App\Repositories;

use App\Models\Img;

class ImageRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Img();
    }

    public function getById($id)
    {
        return $this->model->where('product_id','=', $id, '')->get();
    }

    public function getByImage($id)
    {
        return $this->model->where('img_id','=', $id, '')->first();
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function destroyProductID($id)
    {
        return $this->model->where('product_id','=', $id, '')->delete();
    }



}