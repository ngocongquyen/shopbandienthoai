<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_date','sales','quantity','total_order'
    ];
    protected $primaryKey = 'statistical_id';
    protected $table = 'tbl_statistical';
}
