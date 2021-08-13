<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'Hedieuhanh','Camerasau','Cameratruoc','CPU','Ram','Bonhotrong','Thenho','Thesim','Dungluongpin','Manhinh'
    ];
    protected $primaryKey = 'IDTSSP';
    protected $table = 'tbl_specifications';
}
