<x-layout>
    <style>
        .required:after {
        content:" *";
        color: red;
       }
  </style>
  @section('title', 'Register User')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Register User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Register User</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
  {{-- <section class="content">
    <div class="container">

        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Horizontal Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                <div class="card-body">
        
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label" for="exampleCheck2">Remember me</label>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Sign in</button>
                <button type="submit" class="btn btn-default ">Cancel</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
  <!-- /.card -->

    </div>
</section> --}}

<!-- Horizontal Form -->

  <!-- /.card -->

@section('custom-scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    // //Initialize Select2 Elements
    // $('.select2').select2()
    
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
@endsection



    {{-- @role('Resident') --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                <div class="col-lg-12 margin-tb">
                    {{-- <div class="float-left">
                        <h2>Register User</h2>
                    </div> --}}

                </div>
                </div>
                <div class="card">
                    <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold">{{ __('Register User') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group row my-1">
                                <label for="Image" class="col-sm-4 col-form-label text-md-right">{{ __('Profile Picture (2x2)') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="file"  class="form-control @error('image') is-invalid @enderror" name="image">
                                    
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row my-1">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right required">{{ __('Last Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" placeholder="Enter Last Name..." required autocomplete="lastName" autofocus>
                                    
                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right required">{{ __('First Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" placeholder="Enter First Name..." required autocomplete="firstName" autofocus>
                                    
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="middleName" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="middleName" type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ old('middleName') }}" placeholder="Enter Middle Name..." autocomplete="middleName" autofocus>
                                    
                                    @error('middleName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="email" class="col-md-4 col-form-label text-md-right required">{{ __('E-Mail Address') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="email" placeholder="example@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right required">{{ __('Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password.." required autocomplete="new-password">
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right required">{{ __('Confirm Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password..." required autocomplete="new-password">
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="contactNo" class="col-md-4 col-form-label text-md-right required">{{ __('Contact Number') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="contactNo" type="tel" pattern="[0-9]{11}" placeholder="09123456789" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" value="{{ old('contactNo') }}" required autocomplete="contactNo">
                                    
                                    @error('contactNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="houseNo" class="col-md-4 col-form-label text-md-right required">{{ __('House Number') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="houseNo" type="text" class="form-control @error('houseNo') is-invalid @enderror" name="houseNo" value="{{ old('houseNo') }}" placeholder="Enter House No..." required autocomplete="houseNo">
                                    
                                    @error('houseNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="street" class="col-md-4 col-form-label text-md-right required">{{ __('Street') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" placeholder="Enter Street..." required autocomplete="street">
                                    
                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="dob" class="col-md-4 col-form-label text-md-right required">{{ __('Date of Birth') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="dob" type="date" max='2003-12-31' data-date-format="YYYY MM DD" class="form-control  @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="gender" class="col-md-4 col-form-label text-md-right required">{{ __('Sex') }}</label>
                                
                                <div class="col-md-6">
                                    
                                      <input id="gender" type="radio" name="gender" value="male" class=" @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                      <label for="male">Male</label>
                                    
                                      <input id="gender" type="radio" name="gender" value="female" class=" @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                      <label for="female">Female</label>
                                    
                                    {{--   <input id="gender" type="radio" name="gender" value="rather not say" class=" @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                      <label for="others">Others</label> --}}
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="civilStatus" class="col-md-4 col-form-label text-md-right required">{{ __('Civil Status') }}</label>
                                
                                <div class="col-md-6">
                                    
                                      <input id="civilStatus" type="radio" value="Single" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="{{ old('civilStatus') }}" required autocomplete="civilStatus">
                                      <label for="single">Single</label>
                                    
                                      <input id="civilStatus" type="radio" value="Married" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="{{ old('civilStatus') }}" required autocomplete="civilStatus">
                                      <label for="married">Married</label>
                                    
                                      <input id="civilStatus" type="radio" value="Widowed" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="{{ old('civilStatus') }}" required autocomplete="civilStatus">
                                      <label for="widowed">Widowed</label>

                                      <input id="civilStatus" type="radio" value="Widower" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="{{ old('civilStatus') }}" required autocomplete="civilStatus">
                                      <label for="widowed">Widower</label>
    
                                      <input id="civilStatus" type="radio" value="Divorced" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="{{ old('civilStatus') }}" required autocomplete="civilStatus">
                                      <label for="divorce">Divorced</label>
                                </div>
                            </div>
    
                            <div class="form-group row my-1">
                                <label for="citizenship" class="col-md-4 col-form-label text-md-right required">{{ __('Citizenship') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="citizenship" type="text" class="form-control @error('citizenship') is-invalid @enderror" name="citizenship" value="{{ old('citizenship') }}" placeholder="Enter Citizenship..." required autocomplete="citizenship">
                                    
                                    @error('citizenship')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="role" class="col-md-4 col-form-label text-md-right required">{{ __('Role') }}</label>
                                
                                <div class="col-md-6">
                                    {{-- {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!} --}}
                                    <select name="roles" class="form-control form-control-md mb-3">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
    
                            <div class="form-group row my-1">
                                <div class="col-md-6 offset-md-4 ">
                                    <button  type="submit" class="btn btn-primary fw-bold">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
    
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endrole --}}
</x-layout>
