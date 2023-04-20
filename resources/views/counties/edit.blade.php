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
    <li class="breadcrumb-item"><a href="{{ route('counties.index') }}">Counties</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit County Name</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('counties.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
        <h3 class="card-title">Edit County Name</h3>
        <form action="{{ route('counties.update', $county->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">County Name</label>
                <input type="text" name="county_name" value="{{ $county->county_name }}" class="form-control" id="categoryName">
                </div>
            </div>            
            <div>
                <button type="submit" class="btn btn-success mt-2">Update County</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
