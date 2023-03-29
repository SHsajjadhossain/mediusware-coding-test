@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <div class="card">
        <form action="{{ route('product.filter') }}" method="GET" class="card-header">
            @csrf
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                </div>
                <div class="col-md-2">
                    <select name="variant" id="" class="form-control">

                    </select>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="price_from" aria-label="First name" placeholder="From" class="form-control">
                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-response">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse ($all_products as $key => $product)
                            <tr>
                                <td>{{ $all_products->firstItem() + $key }}</td>
                                <td>{{ $product->title }} <br> {{ $product->created_at }}</td>
                                <td style="width: 40%;">{{ $product->description }}</td>
                                <td>
                                    <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant{{ $product->id }}">

                                        @foreach ( get_variant($product->id) as $single_variant)
                                        <dt class="col-sm-3 pb-0">
                                            {{ $single_variant->relation_to_product_variants_color->variant }}/{{ $single_variant->relation_to_product_variants_size->variant }}@if ($single_variant->product_variant_three == "")
                                                /
                                            @else
                                            /{{ $single_variant->relation_to_product_variants_style->variant }}
                                            @endif
                                        </dt>
                                        <dd class="col-sm-9">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-4 pb-0">Price : {{ $single_variant->price }}</dt>
                                                <dd class="col-sm-8 pb-0">InStock : {{ $single_variant->stock }}</dd>
                                            </dl>
                                        </dd>
                                        @endforeach

                                    </dl>
                                    <button onclick="$('#variant{{ $product->id }}').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                                    </div>
                                </td>


                                {{-- <td>1</td>
                                <td>T-Shirt <br> Created at : 25-Aug-2020</td>
                                <td>Quality product in low cost</td>
                                <td>
                                    <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">

                                        <dt class="col-sm-3 pb-0">
                                            SM/ Red/ V-Nick
                                        </dt>
                                        <dd class="col-sm-9">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-4 pb-0">Price : {{ number_format(200,2) }}</dt>
                                                <dd class="col-sm-8 pb-0">InStock : {{ number_format(50,2) }}</dd>
                                            </dl>
                                        </dd>
                                    </dl>
                                    <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                                    </div>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="text-danger">No Product To Show</span>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer">
            {{ $all_products->links('products.products-paginetor') }}
            {{-- <div class="row justify-content-between">
                <div class="col-md-6">
                    <p>Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} out of {{ $paginator->total() }}</p>
                </div>
                <div class="col-md-2">
                </div>
            </div> --}}
        </div>
    </div>

@endsection
