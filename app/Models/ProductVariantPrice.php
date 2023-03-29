<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
    // $fillable = [
    //     'product_variant_one', 'product_variant_two', 'product_variant_three', 'price', 'stock','products_id'
    // ];

    function relation_to_product_variants_color(){
        return $this->hasOne(ProductVariant::class, 'id', 'product_variant_one');
    }

    function relation_to_product_variants_size(){
        return $this->hasOne(ProductVariant::class, 'id', 'product_variant_two');
    }
    function relation_to_product_variants_style(){
        return $this->hasOne(ProductVariant::class, 'id', 'product_variant_three');
    }
}
