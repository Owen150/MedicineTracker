@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <style>
    .my-nav {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }
  </style>
@endpush

@section('content')

<nav class="page-breadcrumb my-nav" >
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>

  <div style="display: flex; flex-direction: row-reverse;">
    <button class="btn btn-danger">Cancel</button>
  </div>
</nav>
<div class="alert alert-success" role="alert" id="success">
  Record was added successfully
</div>

<div class="alert alert-danger" role="alert" id="danger">
  Sytem error: Ensure all values are filled correctly
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Users</h4>
        <p class="text-muted mb-4">Create Users</p>
        <form id="signupForm">
          

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" class="form-control" name="name" type="text" autocomplete="off" required placeholder="Full Name">
                </div>

                
               
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="employee_number" class="form-label">Employee Number</label>
                <input id="employee_number" class="form-control" name="employee_number" type="text" autocomplete="off" required placeholder="Employee Number">
              </div>

              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input id="phone_number" class="form-control" name="phone_number" type="text" autocomplete="off" required placeholder="+25471000000">
              </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Designation</label>
                    <input id="designation" class="form-control" name="designation" type="text" autocomplete="off" required placeholder="User Designation">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Email</label>
                    <input id="email" class="form-control" name="email" type="email" autocomplete="off" required placeholder="user@mail.com">
              </div>
            </div>

            <div class="row mb-3">
              

              <div class="col-md-6">
                <label for="role" class="form-label">Sytem Role</label>
                <select class="form-select" name="role" id="role" required>
                    
                    <option  value="admin">{{strtolower('ADMIN')}}</option>
                    <option  value="cp">{{strtolower('COUNTY PHARMACIST')}}</option>
                    <option  value="cd">{{strtolower('MEDICAL DEPARTMENT DIRECTOR')}}</option>
                    <option  value="co">{{strtolower('MEDICAL DEPARTMENT CHIEF OFFICER')}}</option>
                    <option  value="ee">{{strtolower('EXECUTIVE')}}</option>
                   
                </select>
              </div>

              <div class="col-md-6" id="facility-div">
                <label for="facility" class="form-label">Select User Facility</label>
                <select class="form-select" name="facility" id="facility">
                    @foreach ($facilities as $facility)
                        <option  value="{{$facility->id}}">{{$facility->name}}</option>
                    @endforeach
                </select>
              </div>
             
            </div>


            <input class="btn  btn-primary" type="submit" value="Submit" id="submits">

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
  <script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
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
  <script src="{{ asset('assets/js/pickr.js') }}"></script>
  <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
  <script >
    
    $('#facility-div').hide();

    $('#success').hide();

    $('#danger').hide();

    $('#role').on('change', function() {

      var role = $('#role').find(":selected").val();
        
      if (role == 'cp' || role == 'cd' || role == 'co'|| role == 'admin') {
        $('#facility-div').hide();
      } else {
        $('#facility-div').show();
      }

    });
    
    function postData() {

        
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('name',$('#name').val());
        data.append('employee_number',$('#employee_number').val());
        data.append('designation',$('#designation').val());
        data.append('email',$('#email').val());
        data.append('phone_number',$('#phone_number').val());
        data.append('role',$('#role').find(":selected").val());
        data.append('facility',$('#facility').find(":selected").val());
        

        $.ajax({
            type: "POST",
            url: "{{ route('users.store') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
              if(response == 1) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                
                $('#success').show();

                

                setTimeout(changeLoc, 1500);

              } else {
                  $('#danger').show();

              }  
                        
            }
        });
        
    }

   $('#submits').on('click', postData);

    function changeLoc() {
      location.href = '/users';   
    }
   
  </script>
@endpush