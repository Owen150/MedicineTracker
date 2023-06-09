@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('facilityProducts.index') }}">Facility Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Facility Products</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Create Facility Products</h3>
                            <p class="text-muted">Fill out details to create new Facility Products</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('facilityProducts.index') }}" class="btn btn-md btn-danger">Cancel <span><i
                                        class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ url('/facilityProducts') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="facility_id">Facility ID</label>
                                <input required type="text" class="form-control" name="facility_id" placeholder="Enter Facility ID">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="product_id">Product ID</label>
                                <input required type="text" class="form-control" name="product_id" placeholder="Enter Product ID">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <input required type="text" class="form-control" name="quantity" placeholder="Enter Quantity">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
