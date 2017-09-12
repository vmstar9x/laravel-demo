<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_id', 'category_name', 'category_img', 'category_price', 'category_description', 'category_status', 'category_time_created', 'category_time_updated'
    ];
}
