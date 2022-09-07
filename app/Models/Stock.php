<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function stockCategory() {

        return $this->hasOne(Category::class, 'id', 'category_id');

    }

    public function stockUnit() {

        return $this->hasOne(Unit::class, 'id', 'unit_id');

    }
}
