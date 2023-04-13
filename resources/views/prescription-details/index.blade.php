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
    <li class="breadcrumb-item active" aria-current="page">Prescription Details</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('prescription.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Close</button></a>
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Prescription Details</h6>
        <div class="table-responsive">         
          <table class="table table-bordered table-hover mt-3" id="dataTableExample" >
            <thead>
              <tr>
                <th>#</th>
                <th>Patient Number</th>
                <th>Patient Name</th>
                <th>Patient Address</th>
                <th>Doctor</th>
                <th>Product Name</th>
                <th>Prescription Date</th>
                <th>Prescription Cost</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($prescription as $prescription)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->patient_number }}</td>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->patient_name }}</td>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->patient_address }}</td>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->doctor }}</td>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->product_name }}</td>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->prescription_date }}</td>
                    <td>{{ App\Models\Prescription::where('id','=', $prescription->order_id)->first()->prescription_cost }}</td>
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