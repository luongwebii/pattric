<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroupItem extends Model
{
    use HasFactory;
    protected $table = 'product_group_item';

    protected $guarded = ['id'];

    

    public function productGroup()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
