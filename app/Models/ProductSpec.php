<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSpec extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function productCategories() {

        return $this->hasOne(Category::class, 'id', 'category_id');

    }

    public function productUnits() {

        return $this->hasOne(Unit::class, 'id', 'unit_id');

    }

}
