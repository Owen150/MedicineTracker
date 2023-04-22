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
    <li class="breadcrumb-item"><a href="{{ route('wards.index') }}">Wards</a></li>
    <li class="breadcrumb-item active" aria-current="page">Wards Table</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('wards.create')}}"><button class="btn btn-success mb-1 mb-md-0">Add Ward</button></a>
  </div>
</nav>

<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Wards Table</h6>
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-bordered table-hover mt-3" id="dataTableExample" >
            <thead>
              <tr>
                <th>ID</th>
                <th>WARD NAME</th>
                <th>COUNTY</th>
                <th>SUBCOUNTY</th>
                <th>LOCATION</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                                    
                @foreach ($wards as $ward)
                <tr>
                    <td>{{ $ward->id }}</td>
                    <td>{{ $ward->ward_name }}</td>
                    <td>{{ App\Models\County::where('id','=', $ward->county_id)->first()->county_name }}</td>
                    <td>{{ App\Models\Subcounty::where('id','=', $ward->subcounty_id)->first()->constituency_name }}</td>
                    <td>{{ $ward->ward_location }}</td>
                    <td style="display: flex; gap: 10px">
                        <a href="{{ route('wards.edit', $ward->id) }}"><span class="text-success">Edit</span></a>
                        <form id='frm'
                         action="{{ route('wards.destroy',$ward->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <span id="ward-delete" class="text-danger">Delete</span>
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
    
    var del = document.getElementById('ward-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush