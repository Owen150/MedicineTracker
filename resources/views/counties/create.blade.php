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
    <li class="breadcrumb-item active" aria-current="page">Add County</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('counties.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

<div class="col-md-12">
    <div class="card ">
        <div class="card-body">
            <h6 class="card-title">Add County</h6>
            <form action="{{ route('counties.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                <label for="exampleInputUsername2" class="mb-2">County Name</label>
                <input type="text" name="county_name" class="form-control" placeholder="Enter County Name" required>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success mt-3">Add County</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
