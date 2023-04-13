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
    <li class="breadcrumb-item"><a href="{{ route('prescription.index') }}">Prescriptions</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Prescription</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('prescription.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-body">

        <h6 class="card-title">Add Prescription</h6>

        <form action="{{ route('prescription.store') }}" method="POST">
        @csrf

        <div class="row">

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Patient Number</label>
            <input type="number" name="patient_number" class="form-control" placeholder="Enter Patient Number" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Patient Name</label>
            <input type="text" name="patient_name" class="form-control" placeholder="Enter Patient Name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Prescription Date</label>
            <input type="text" name="prescription_date" class="form-control" placeholder="Enter Prescription Date">
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Prescription Cost</label>
            <input type="text" name="prescription_cost" class="form-control" placeholder="Enter Prescription Cost">
          </div>

        </div>

        <div>
          <button type="submit" class="btn btn-success mt-3">Add Prescription</button>
        </div>
        </form>

      </div>
    </div>
  </div>

@endsection
