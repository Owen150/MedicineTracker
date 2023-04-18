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

  .btn-div {
      display: flex;
      flex-direction: row-reverse;
      gap: 5px;
    }
  </style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="{{ route('supplier-product-catalogue.index') }}">Supplier Products Catalogue</a></li>
    <li class="breadcrumb-item active" aria-current="page">Supplier Products Catalogue Table</li>
  </ol>

  <div class="btn-div">
    <button type="button" class="btn btn-warning mb-1 mb-md-0">Import Excel</button>
    <button type="button" class="btn btn-success mb-1 mb-md-0">Export Excel</button>     
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Supplier Products Catalogue Table</h6>
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-striped table-bordered" id="dataTableExample" >
            <thead>
              <tr>
                <th>#</th>
                <th>Supplier Name</th>
                <th>Product Code</th>
                <th>Remaining Amount</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($supplierProductCatalogue as $supplierProductCatalogue)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ App\Models\Supplier::where('id','=', $supplierProductCatalogue->supplier_id)->first()->name }}</td>
                    <td>{{ $supplierProductCatalogue->product_code }}</td>
                    <td>{{ $supplierProductCatalogue->remaining_amount }}</td>
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
    
    var del = document.getElementById('product-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush