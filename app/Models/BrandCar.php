<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'brand_car';
    protected $guarded = [];

    public $timestamps = true;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function getAll()
    {
        $query = self::query();

        $query->where('status', '=', (int)self::STATUS_ACTIVE)->orderBy('brand_name','asc');

        $data = $query->get();

        return $data;
    }
}
