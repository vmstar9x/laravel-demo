<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    public $timestamps = false;
    protected $table = 'img';
    protected $primaryKey = 'img_id';
    protected $fillable = [
        'img_id', 'img_path', 'product_id'
    ];
}
