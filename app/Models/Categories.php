<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'id';
    protected $table = 'categories';
    protected $guarded = [];

    public $timestamps = true;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
}
