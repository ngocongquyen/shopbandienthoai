<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'coupon_name','coupon_time','coupon_condition','coupon_number','coupon_code','coupon_date_start','coupon_date_end','coupon_status'
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';
}
