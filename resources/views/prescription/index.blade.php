@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }
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
    <li class="breadcrumb-item active" aria-current="page">Prescriptions Table</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('prescription.create')}}"><button class="btn btn-success mb-1 mb-md-0">Add Prescription</button></a>
  </div>
</nav>

<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Prescriptions Table</h6>
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-bordered table-hover mt-3" id="dataTableExample" >
            <thead>
              <tr>
                <th>#</th>
                <th>Patient Number</th>
                <th>Patient Name</th>
                <th>Prescription Date</th>
                <th>Prescription Cost</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($prescriptions as $prescription)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ $prescription->patient_number }}</td>
                    <td>{{ $prescription->patient_name }}</td>
                    <td>{{ $prescription->prescription_date }}</td>
                    <td>{{ $prescription->prescription_cost }}</td>
                    <td style="display: flex; gap: 10px">
                        <a href="{{ route('prescription.edit', $prescription->id) }}"><span class="text-success">Edit</span></a>
                        <form id='frm'
                         action="{{ route('prescription.destroy',$prescription->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <span id="prescription-delete" class="text-danger">Delete</span>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script defer>
    
    var del = document.getElementById('prescription-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush