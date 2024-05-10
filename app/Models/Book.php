<?php

namespace App\Models;

use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'booktitle',
        'bookauthor',
        'bookdiscribtion',
    ];
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function who_loved_this_book()
    {
        return $this->belongsToMany(User::class,'book_user_pivot');
    }
    public function who_rated_this_book()
    {
        return $this->belongsToMany(User::class,'book_user_rating')->withPivot('rating');
    }
}
