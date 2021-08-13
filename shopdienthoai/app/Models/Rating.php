<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id','rating_number','rating_content','customer_id'
    ];
    protected $primaryKey = 'rating_id';
    protected $table = 'tbl_rating';

    public function customer() {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    
}
