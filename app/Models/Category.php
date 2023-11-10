<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name_en',
        'icon',
        'image',
        'status',
        'meta_keywords_en',
        'meta_description_en',
    ];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

}
