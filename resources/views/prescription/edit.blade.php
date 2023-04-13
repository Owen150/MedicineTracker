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
    <li class="breadcrumb-item active" aria-current="page">Edit Prescription</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('prescription.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <h3 class="card-title">Edit Prescription</h3>

        <form action="{{ route('prescription.update', $prescription->id) }}" method="POST">
            @csrf
            @method('PUT')

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Patient Number</label>
              <input type="number" name="patient_number" value="{{ $prescription->patient_number }}" class="form-control" id="" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Patient Name</label>
              <input type="text" name="patient_name" value="{{ $prescription->patient_name }}" class="form-control" id="" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Prescription Date</label>
              <input type="text" name="prescription_date" value="{{ $prescription->prescription_date }}" class="form-control" id="" placeholder="" required>
            </div>

            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Prescription Cost</label>
              <input type="text" name="prescription_cost" value="{{ $prescription->prescription_cost }}" class="form-control" id="" placeholder="" required>
            </div>

          </div>
          
          <div>
              <button type="submit" class="btn btn-success mt-2">Update Prescription</button>
          </div>
        </form>

      </div>
    </div>
  </div>

@endsection
