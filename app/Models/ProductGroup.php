<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;
    protected $table = 'product_group';

    protected $guarded = ['id'];

    
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }
    public function groupItems()
    {
        return $this->hasMany(ProductGroupItem::class, 'product_group_id');
    }

}
