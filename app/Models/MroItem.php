<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MroItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function mroCategory() {

        return $this->hasOne(Category::class, 'id', 'category_id');

    }

    public function mroUnit() {

        return $this->hasOne(Unit::class, 'id', 'unit_id');

    }
}
