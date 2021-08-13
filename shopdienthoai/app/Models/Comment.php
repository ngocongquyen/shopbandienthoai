<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'comment','comment_name','comment_product_id','comment_date','comment_parent_comment'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

  
    public function product() {
        return $this->belongsTo('App\Models\Product','comment_product_id');
    }
}
