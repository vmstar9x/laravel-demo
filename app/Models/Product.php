<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id', 'product_name', 'product_img', 'product_price', 'product_description', 'product_status', 'product_time_created', 'product_time_updated'
    ];

}
