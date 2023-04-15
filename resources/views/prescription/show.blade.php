@extends('layouts.app')

@push('plugin-styles')
  <style>
    .my-nav {
       display: flex;
    }

    .cancel-btn {
        width: 100%;
        text-align: end;
        
    }

    </style>
@endpush

@section('content')
<nav class="page-breadcrumb my-nav">
  <ol class="breadcrumb" style="width: 100%">
    <li class="breadcrumb-item"><a href="#">Special pages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
  </ol>

  <div class="cancel-btn">
    <a href="{{route('purchase-order.index')}}" class="btn btn-danger">back <ion-icon  style="position: relative; font-size: 15px; top: 2.5px" name="caret-back-circle-outline"></ion-icon></a>
  </div>
</nav>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Show Products
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prescription Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table id="dataTableExample" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Product Price</th>
                  <th>Package Size</th>
                  <th>Package Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ App\Models\Product::where('id','=', $prescription->product_id)->first()->product_name }}</td>
                  <td>{{ App\Models\Product::where('id','=', $prescription->product_id)->first()->price }}</td>
                  <td>{{ App\Models\Product::where('id','=', $prescription->product_id)->first()->package_size }}</td>
                  <td>{{ App\Models\Product::where('id','=', $prescription->product_id)->first()->package_quantity }}</td>
                </tr>
              </tbody>
            </table>
          </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
    </div>
</div>
</div>
@endsection