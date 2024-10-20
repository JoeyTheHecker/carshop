<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $timestamps = true;

    const STATUS_ACTIVE = 0;
    const STATUS_INACTIVE = 1;
    const STATUS_SOLD = 2;
    const STATUS_DELETED = 3;

    public function generateUniqueID()
    {
        return date('Y').''.substr(str_shuffle("0123456789").''.rand(000,999), 0, 10);
    }
}
