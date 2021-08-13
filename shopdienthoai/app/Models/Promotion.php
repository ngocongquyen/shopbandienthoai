<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'promotion_type'
    ];
    protected $primaryKey = 'promotion_id';
    protected $table = 'tbl_promotion';
}
