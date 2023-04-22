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
    <li class="breadcrumb-item active" aria-current="page">Edit Ward</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('wards.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
        <h3 class="card-title">Edit Ward</h3>
        <form action="{{ route('wards.update', $ward->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ward Name</label>
                    <input type="text" name="ward_name" value="{{ $ward->ward_name }}" class="form-control" id="categoryName" placeholder="">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">County</label>
                    <select class="form-select" name="county_id" id="counties">
                        @foreach ($counties as $county)
                        <option @if ($county->id == $ward->county_id)
                            selected
                        @endif value="{{ $county->id }}">{{ $county->county_name }}</option>
                        @endforeach
                    </select>            
                </div>
                <div class="col-md-6">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Sub-county</label>
                    <select class="form-select" name="subcounty_id" id="subcounties">
                        @foreach ($subcounties as $subcounty)
                        <option @if ($subcounty->id == $ward->subcounty_id)
                            selected
                        @endif value="{{ $subcounty->id }}">{{ $subcounty->constituency_name }}</option>
                        @endforeach
                    </select>            
                </div>
                <div class="col-md-6">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Constituency Name</label>
                    <input type="text" name="constituency_name" value="{{ $subcounty->constituency_name }}" class="form-control" id="categoryName" placeholder="">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ward</label>
                    <input type="text" name="ward" value="{{ $subcounty->ward }}" class="form-control" id="categoryName" placeholder="">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success mt-2">Update Sub-county</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
