@extends('layouts.app')


@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <style>
    .page-content {
        background: #e5e7eb !important;
    }
    .product-catalogue {
        height: 70vh;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 10px;
    }
    .product-panel {
        border-radius: 0.25rem;
    }

 
    
    thead {
            background-color: rgb(147 51 234) !important;
            
            
        }
    thead tr th {
        color: black !important;
    }
    td {
        margin: 0 !important;
        padding: 2px !important;
    }
 
    #input  {
            outline: none !important;
            border: none !important;
            border: 1px solid #e5e7eb !important;
            height: 36px !important;
            
            
            border-radius: 0.25rem;
            padding-left: 10px !important;
            color: rgb(68, 68, 68);
        }
  </style>
@endpush


@section('content')
<div class="row">
    <div class="col-md-4">

        <!-- top search bar -->
        <div class="search-bar mb-3">
          <div class="row">
              <div class="col-md-6">
                  <select name="product" class="js-example-basic-single form-select" data-width="100%">
                      <option value="">Select Medicine</option>
              </select>
              </div>
              <div class="col-md-6">
                  <div class="search">
                    <input id="search" type="search" name="_token" class="form-control" placeholder="Search Product">
                  </div>
              </div>
          </div>
        </div>
        
        <!-- product catalogue -->
        <div class="product-catalogue">
            <div class="row" id="">
                <!--- col for each product --->
                @foreach ($products as $product)
                  <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">{{ $product->product_name }}</h6>
                        </div>
                    </div>
                  </div>
                @endforeach                
            </div>

            <!--- col for search result --->
            <div class="row">
              <div class="col-md-4 mb-2" id="searchResult"></div>
            </div>
        </div>
        
    </div>

    <div class="col-md-8" style="background: #fff;border-radius:0.25rem">
        <div class="container-fluid mt-2 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th class="text-end">Batch</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Total</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody class="mb-3">
                    <tr class="">
                      <td class="text-start">1</td>
                      <td class="text-start">
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:150px">
                      </td>
                      <td >
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                      </td>
                      <td>
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                      </td>
                      <td>
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                      </td>
                      <td>
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                      </td>
                      <td class="p-1">
                        <div  style="width: 20px;background: #fca5a5; border-radius:0.15rem; border: 0.7px solid #ef4444; " class="text-center"><i class="fa-solid fa-trash-can" style="color: #ef4444; font-size: 10px; "></i></div>
                      </td>
                    </tr>
                    
                    <tr class="">
                        <td class="text-start">1</td>
                        <td class="text-start">
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:150px">
                        </td>
                        <td >
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                        </td>
                        <td>
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                        </td>
                        <td>
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                        </td>
                        <td>
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                        </td>
                        <td class="p-1">
                            <div  style="width: 20px;background: #fca5a5; border-radius:0.15rem; border: 0.7px solid #ef4444; " class="text-center"><i class="fa-solid fa-trash-can" style="color: #ef4444; font-size: 10px; "></i></div>
                          </td>
                      </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="container-fluid mt-5 w-100">
            <div class="row">
              <div class="col-md-6 ms-auto">
                  <div class="table-responsive">
                    <table class="table">
                        <tbody>
                         
                          <tr class="bg-white" style="border-radius: 0.25rem;">
                            <td class="text-bold-800">Total</td>
                            <td class="text-bold-800 text-end">$ 12,000.00</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript">
    $('#search').on('keyup', function(){

        $inputSearch = $(this).val().toLowerCase();
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('search', $inputSearch);

        if($inputSearch == ''){
          $('#searchResult').html('');
          $('#searchResult').hide();
        }
        else{
          $.ajax({
            type: "POST",
            url: '/search',
            data: data,
            
            success: function(data){
              console.log(data);            
            }
          }); 
        }        
    });
</script>


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
 
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script defer>
        $(document).ready(function(){
            var body = $('body');
            $('.sidebar-header .sidebar-toggler').toggleClass('active not-active');
      if (window.matchMedia('(min-width: 992px)').matches) {
        
        body.toggleClass('sidebar-folded');
      } else if (window.matchMedia('(max-width: 991px)').matches) {
       
        body.toggleClass('sidebar-open');
      }
    });
    </script>
@endpush