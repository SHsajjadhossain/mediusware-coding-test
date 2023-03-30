<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        // $get_colour_variant = ProductVariant::where('variant_id', '1')->get(['variant', 'product_id']);
        // return $get_colour_variant;
        return view('products.index', [
            'all_products' => Product::paginate('5'),
        ]);
    }

    public function filter(Request $request)
    {
        if ($request->title) {
            $result = Product::where('title','LIKE','%'.$request->title.'%')->paginate('5');
        }

        if ($request->price_from && $request->price_to) {
            $result = ProductVariantPrice::whereBetween('price', [$request->price_from, $request->price_to])->paginate('5');
        }

        if ($request->date) {
            $result = Product::where('created_at','LIKE','%'.$request->date.'%')->paginate('5');
        }

        if ($request->variant) {
            $result = Product::where('id','LIKE','%'.$request->variant.'%')->paginate('5');
        }

        return view('products.index', [
            'all_products' => $result,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $product_id = Product::insertGetId([
            'title' => $request->product_name,
            'sku' => $request->product_sku,
            'description' => $request->product_description,
            'created_at' => Carbon::now()
        ]);

        foreach ($request->product_variant as $key => $variant) {
            foreach ($request->product_variant[$key]['value'] as $subkey => $variants) {
                $provar = $request->product_variant[$key]['option'];

                ProductVariant::create([
                    'variant' => $variants,
                    'variant_id' => $provar,
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
            }
        }

        $color_variants['product_variant_one'] = ProductVariant::where('product_id', 1)->where('variant_id', '1')->get('id');
        $size_variants['product_variant_two'] = ProductVariant::where('product_id', 2)->where('variant_id', '2')->get('id');
        $style_variants['product_variant_three'] = ProductVariant::where('product_id', 6)->where('variant_id', '6')->get('id');

        ProductVariantPrice::create($color_variants,$size_variants,$style_variants,['price' => $request->price,'stock' => $request->stock,'product_id' => $product_id, 'created_at' => Carbon::now()]);

        return back()->with('success', 'Product Created Successfully!!');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
