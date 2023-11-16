<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name_en',
        'category_slug_en',
        'parent_id',
        'icon',
        'image',
        'status',
        'meta_keywords_en',
        'meta_description_en',
    ];

    public function children()
    {
      return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

}
