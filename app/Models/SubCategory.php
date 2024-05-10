<?php

namespace App\Models;

use App\Models\Book;
use App\Models\MainCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    protected $fillable = ['sub_category_name'];
    public function maincategory()
    {
        return $this->belongsTo(MainCategory::class);
    }
    public function book()
    { 
        return $this->hasMany(Book::class);
    }
}