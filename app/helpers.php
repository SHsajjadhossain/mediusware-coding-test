<?php

use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;

function get_variant($product_id)
{
    $single_variant = ProductVariantPrice::where('product_id', $product_id)->get();
    return $single_variant;
}

// function get_colour_variant()
// {
//     $product_variant_id = ProductVariant::where('variant_id', '1')->get();

// }

function get_size_variant($product_id){
    return ProductVariant::where('product_id', $product_id)->get();
}

// [${currentIndex}][value]

// [${currentIndex}][option]
?>
