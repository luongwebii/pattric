<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'product_name_en',
        'product_slug_en',
        'product_code',
        'model',
        'price',
        'product_qty',
        'drawing',
        'orient',
        'area_sm',
        'bottom_butter',
        'racking_butter',
        'man_way',
        'capacity',
        'product_tags_en',
        'size',
        'product_color',
        'discount',
        'short_description_en',
        'long_description_en',
        'image',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status',
        'meta_keywords_en',
        'meta_description_en',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'category_name_en',  'category_slug_en',  'image');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }


    public function multi_images()
    {
        return $this->hasMany(ProductMultiImage::class);
    }
}
