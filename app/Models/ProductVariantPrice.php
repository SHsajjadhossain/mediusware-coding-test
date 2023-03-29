<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
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
