@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <style>
    .rights-nav {
      display: grid;
      grid-template-columns: 1fr 25vw 1fr;
    }

    .budget-area {
      padding: 10px;
      background: #a5b4fc;
      border-radius: 0.25rem;
    }

   
  </style>
@endpush

@section('content')
<nav class="page-breadcrumb rights-nav">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('drawing-rights.index')}}">Drawing rights</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>

  

</nav>

<div id="alert-div"></div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div style="display: flex; gap: 20px">
          <div>
              <h4 class="card-title">Facility</h4>
              <p class="text-muted mb-4">Details</p>
          </div>
          <div style="flex: 1 1 0%; text-align:end">
              <h4 class="card-title">Budget</h4>
              <p class="text-muted mb-4">Available budget balance</p>
          </div>
      </div>
      

      <div class="mb-3" style="display: flex; gap: 20px">
          <div style="width: 10vw;height: 20vh; margin-">
              <img src="https://cdn-icons-png.flaticon.com/512/4006/4006511.png" alt="" srcset="" style="width: 100%;height: 100%">
          </div>
          <div>
              <h4 class="pt-1" id="facility-name"></h4>

              <p class="mt-5 pt-2 mb-2"><span class="text-muted">Type:</span > <span id="facility-type"></span></p>
              <p class=""><span class="text-muted">Contact:</span> <span id="facility-contact"></span></p>
          </div>
          <div style="width: 40vw"></div>
          <div style="flex: 1 1 0%; text-align:end">
              <div style="text-align: center; background: #f9fafb; border-radius:0.375rem;">
                  <h5 class="p-2" ><span class="text-success">KSH</span> <span class="text-success" id="availableAmt">{{number_format($budget_left, 2)}}</span></h5>
              </div>
              
              
          </div>
      </div>

      <hr>
        <form id="signupForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Financial Year</label>
                    <select class="form-select" name="age_select" id="finacial" required>
                     
                        <option value="{{$financialYear->id}}">{{$financialYear->name}}</option>
                      
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Facility</label>
                    <select class="form-select" name="age_select" id="facility" required>
                      @foreach ($facilities as $facility)
                        <option value="{{$facility->id}}">{{$facility->name}}</option>
                      @endforeach
                    </select>
                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Workload</label>
                    <input id="worload" class="form-control" name="worload" type="text" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Period</label>
                    <select class="form-select" name="age_select" id="period" required>
                        <option selected >Quanter 1</option>
                        <option>Quanter 2</option>
                        <option>Quanter 3</option>
                        <option>Quanter 4</option>
                        <option>Quanter 5</option>
                        <option>Quanter 6</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Amount</label>
                    <input id="amount" class="form-control" name="amount" type="text" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">End Date</label>
                    <div class="input-group flatpickr" id="flatpickr-date">
                        <input type="text" class="form-control" id="end_date" placeholder="Select date" data-input required>
                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                      </div>
                </div>
            </div>

            <input type="hidden" name="allocated_budget" id="allocated_budget" value="{{$allocatedBudget->id}}">
          
            <input class="btn  btn-primary" type="submit" value="Submit" id="submit">
        </form>
      </div>
    </div>
  </div>
  
</div>


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>

  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>

  <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
  <script defer>
    function postData() {
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('finacial_year',$('#finacial').find(":selected").val());
        data.append('facility',$('#facility').find(":selected").val());
        data.append('worload',$('#worload').val());
        data.append('period',$('#period').find(":selected").val());
        data.append('amount',$('#amount').val());
        data.append('end_date',$('#end_date').val());
        data.append('allocated_budget',$('#allocated_budget').val());

        $.ajax({
            type: "POST",
            url: "{{ route('drawing-rights.store') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
                console.log(response);
                location.href = '/drawing-rights';       
                        
            }
        });
    }

    $('#submit').on('click', postData);


    /**
     * 
     * amount input on change decrease available balance amount
     * 
    */
    var availableAmt = $('#availableAmt').text();

    function removeCommas(str) {
        while (str.search(",") >= 0) {
            str = (str + "").replace(',', '');
        }
        return str;
    };

    

    var rmCommas = removeCommas(availableAmt);

    function format(num, fix) {
    var p = num.toFixed(fix).split(".");
    return p[0].split("").reduceRight(function(acc, num, i, orig) {
        if ("-" === num && 0 === i) {
            return num + acc;
        }
        var pos = orig.length - i - 1
        return  num + (pos && !(pos % 3) ? "," : "") + acc;
    }, "") + (p[1] ? "." + p[1] : "");
}


    console.log(rmCommas - 0);

    var alertTemplate = `
    <div class="alert alert-danger" role="alert" >
        Your balance has depleted. Please top up to continue!
    </div> 
    `;

    if (rmCommas == 0) {
      $('#alert-div').append(alertTemplate);

      $('#submit').hide();

      $('#amount').attr('readonly',true);
    }

    $('#amount').on('input',function(e) {

      if (availableAmt == 0) {
        
        return;
      }
      

      var inputAmt = $(this).val() - 0;

      var amt = rmCommas - inputAmt;

      $('#availableAmt').text(format(amt, 2));
    });

    /**
     * document onload fetch the first facility in select
    */
    
    var facilityVal = $('#facility').find(":selected").val();

    $.ajax({
      type: "GET",
      url: `/drawing-rights-facility-data/${facilityVal}`,
      processData: false,
      contentType: false,
      cache: false,
      error: function (err) {
          console.log(err)
      },
      success: function (response) {
          console.log(response);
                
          if (response) {
            $('#facility-name').text(response.name);
            $('#facility-type').text(response.type);
            $('#facility-contact').text(response.contact_num);
          } 
                     
                        
      }
    });

    /**
     * facility id on change get facility data
    */
    $('#facility').on('change', function(e) {
      
      
      $.ajax({
            type: "GET",
            url: `/drawing-rights-facility-data/${e.target.value}`,
            processData: false,
            contentType: false,
            cache: false,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
                console.log(response);
                
                if (response) {
                  $('#facility-name').text(response.name);
                  $('#facility-type').text(response.type);
                  $('#facility-contact').text(response.contact_num);
                } 
                     
                        
            }
      });

      
    })
  </script>
@endpush