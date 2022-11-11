<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class useratm extends Model
{
    use HasFactory;
    protected $fillable = ['norek','nama','atmbank'];
    protected $table = 'useratm';
    public $timestamps = false;
}
