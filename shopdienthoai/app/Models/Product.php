<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_name','brand_id','product_desc','product_content','product_price','product_quantity','product_sold','product_images','product_status','promotion_id','IDTSSP','product_total_rating','product_total_number',
        'product_views'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function comment() {
        return $this->hasMany('App\Models\Comment');
    }

}
