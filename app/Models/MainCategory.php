<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = ['main_category_name'];
    public function subcategory()
    { 
        return $this->hasMany(SubCategory::class);
    }
}
