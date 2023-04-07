@extends('layouts.app')

@push('plugin-styles')
<style>
  .mynav{
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  .cancel{
    display: flex;
    flex-direction: row-reverse;
  }
</style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('products.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <h3 class="card-title">Edit Product</h3>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product Name</label>
              <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Manufacturer</label>
              <input type="text" name="manufacturers" value="{{ $product->manufacturers }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Unit of Measure</label>
              <input type="text" name="unit_of_measure" value="{{ $product->unit_of_measure }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Package Size</label>
              <input type="text" name="package_size" value="{{ $product->package_size }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Package Quantity</label>
              <input type="number" name="package_quantity" value="{{ $product->package_quantity }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Items in Box</label>
              <input type="number" name="no_of_items_in_box" value="{{ $product->no_of_items_in_box }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>
          
          <div>
              <button type="submit" class="btn btn-success mt-2">Update Product</button>
          </div>
        </form>

      </div>
    </div>
  </div>

@endsection
