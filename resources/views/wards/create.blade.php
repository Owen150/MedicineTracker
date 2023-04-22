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
    <li class="breadcrumb-item"><a href="{{ route('wards.index') }}">Wards</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Ward</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('wards.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

<div class="col-md-12">
    <div class="card ">
        <div class="card-body">
            <h6 class="card-title">Add Ward</h6>
            <form action="{{ route('wards.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputUsername2">Ward Name</label>
                    <input type="text" name="ward_name" class="form-control" placeholder="Enter Ward Name" required>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputUsername2">County</label>
                        <select class="form-select" name="county_id" id="counties">
                            @foreach ($counties as $county)
                            <option value="{{ $county->id }}">{{ $county->county_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputUsername2">Sub-county</label>
                        <select class="form-select" name="subcounty_id" id="subcounties">
                            @foreach ($subcounties as $subcounty)
                            <option value="{{ $subcounty->id }}">{{ $subcounty->constituency_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label for="exampleInputUsername2">Location</label>
                    <input type="text" name="ward_location" class="form-control" placeholder="Enter Ward Location" required>
                </div>
            </div>
        <div>
            <button type="submit" class="btn btn-success mt-3">Add Ward</button>
        </div>
        </form>
        </div>
    </div>
</div>
@endsection
