<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Company;
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

    public function productCompanies() {

        return $this->hasOne(Company::class, 'id', 'company_id');

    }

    public function productDetail($id)
    {
        $productDetail = DB::table('product_specs')
                ->join('categories', 'product_specs.category_id', '=', 'categories.id')
                ->join('companies', 'product_specs.company_id', '=', 'companies.id')
                ->join('units', 'product_specs.unit_id', '=', 'units.id')
                ->select('product_specs.*', 'companies.company_name', 'categories.category', 'units.unit')
                ->where('product_specs.id', $id);
            
            return $productDetail;
    }

}
