<?php

use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;

function get_variant($product_id)
{
    $single_variant = ProductVariantPrice::where('product_id', $product_id)->get();
    return $single_variant;
}

function get_price_variant($product_id)
{
    $single_variant = ProductVariantPrice::where('product_id', $product_id)->get();
    return $single_variant;
}

function get_price_colour_variant()
{
    $color_variant = ProductVariant::where('variant_id', '1')->get(['variant', 'product_id']);
    return $color_variant;

}
function get_price_size_variant()
{
    $size_variant = ProductVariant::where('variant_id', '2')->get(['variant', 'product_id']);
    return $size_variant;

}
function get_price_style_variant()
{
    $style_variant = ProductVariant::where('variant_id', '6')->get(['variant', 'product_id']);
    return $style_variant;

}

function get_size_variant($product_id){
    return ProductVariant::where('product_id', $product_id)->get();
}

// [${currentIndex}][value]

// [${currentIndex}][option]
?>
