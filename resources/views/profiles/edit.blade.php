<x-layout>
    <style>
        .required:after {
        content:" *";
        color: red;
       }
  </style>
    @section('title', 'Edit Profile')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="card">
                        <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold"><b>Profile Picture</b></div>
                          <div class="card-body">
                            <p class="text-center"><img src="{{ asset('images/users/'.$user->profilePath) }}" style="height: 288px; width: auto;"></p>
                            <hr>
                            <p class="card-text"><b>Name: </b>{{ $user->firstName. ' ' .$user->lastName }}</p>
                            <p class="card-text"><b>Email: </b>{{ $user->email }}</p>
                            <p class="card-text"><b>Contact No: </b>{{ $user->contactNo }}</p>
                          </div>
                    </div>
                </div>
    
                <div class="col-md-8">
                    <div class="card">
                        <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold">{{ __('Edit Account Details') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
        
                                <div class="form-group row my-1">
                                    <label for="Image" class="col-sm-4 col-form-label text-md-right  fw-bold">{{ __('Profile Picture (2x2)') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input type="file"  class="form-control @error('image') is-invalid @enderror" name="image">
                                        <span><b>Image must be .jpg / .jpeg / .png</b></span>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row my-1">
                                    <label for="lastName" class="col-md-4 col-form-label text-md-right fw-bold ">{{ __('Last Name') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input readonly @role('Admin')  @endrole id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{$user->lastName }}" placeholder="Enter Last Name..." required autocomplete="lastName">
                                        
                                        @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('The last name must be letters only') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="firstName" class="col-md-4 col-form-label text-md-right fw-bold ">{{ __('First Name') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input readonly @role('Admin')  @endrole id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $user->firstName }}" placeholder="Enter First Name..." required autocomplete="firstName">
                                        
                                        @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('The first name must be letters only') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="middleName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Middle Name') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input @role('Admin')  @endrole id="middleName" type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ $user->middleName }}" placeholder="Enter Middle Name..." autocomplete="middleName">
                                        
                                        @error('middleName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('The middle name must be letters only') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="email" class="col-md-4 col-form-label text-md-right fw-bold ">{{ __('E-Mail Address') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input disabled id="email" placeholder="example@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Enter Email Address..." required autocomplete="email">
                                        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- <div class="form-group row my-1">
                                    <label for="password" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Password') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Confirm Password') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div> --}}
                                
                                <div class="form-group row my-1">
                                    <label for="contactNo" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('Contact Number') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="contactNo" type="tel" pattern="[0-9]{10}" placeholder="9123456789" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" value="{{ $user->contactNo }}" placeholder="Enter Contact No..." required autocomplete="contactNo">
                                        
                                        @error('contactNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="houseNo" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('House Number') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="houseNo" type="text" class="form-control @error('houseNo') is-invalid @enderror" name="houseNo" value="{{ $user->houseNo }}" placeholder="Enter House No..." required autocomplete="houseNo">
                                        
                                        @error('houseNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="street" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('Street') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $user->street }}" placeholder="Enter Street..." required autocomplete="street">
                                        
                                        @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('Date of birth') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="dob" type="date" max='2003-12-31' data-date-format="YYYY MM DD" class="form-control  @error('dob') is-invalid @enderror" name="dob" value="{{ $user->dob }}" required autocomplete="dob">
                                        
                                        {{-- Not sure if this below is applicable or necessary for date
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror --}}
                                    </div> 
                                </div>

                                <div class="form-group row my-1">
                                 <label for="sex" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('Sex') }}</label>
                                 
                                 <div class="col-md-6">
                                     <input readonly id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ $user->sex }}" placeholder="Enter sex..." required autocomplete="sex">
                                     
                                     @error('sex')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                     @enderror
                                 </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="civilStatus" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('Civil Status') }}</label>
                                    
                                    <div class="col-md-6">
                                        {{--   <input @if ($user->civilStatus == 'Single') return checked @endif id="civilStatus" type="radio" value="Single" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="{{ old('civilStatus') }}" required autocomplete="civilStatus"> --}}
                                          <input {{ $user->civilStatus == "Single" ? 'checked' : '' }} id="civilStatus" type="radio" value="Single" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Single" required autocomplete="civilStatus">
                                          <label for="Single">Single</label>
                                        
                                          <input {{ $user->civilStatus == "Married" ? 'checked' : '' }} id="civilStatus" type="radio" value="Married" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Married" required autocomplete="civilStatus">
                                          <label for="Married">Married</label>
                                        
                                          <input {{ $user->civilStatus == "Widowed" ? 'checked' : '' }} id="civilStatus" type="radio" value="Widowed" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Widowed" required autocomplete="civilStatus">
                                          <label for="Widowed">Widowed</label>

                                          <input {{ $user->civilStatus == "Widower" ? 'checked' : '' }} id="civilStatus" type="radio" value="Widower" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Widowed" required autocomplete="civilStatus">
                                          <label for="Widowed">Widower</label>
        
                                          <input {{ $user->civilStatus == "Divorced" ? 'checked' : '' }} id="civilStatus" type="radio" value="Divorced" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Divorced" required autocomplete="civilStatus">
                                          <label for="Divorce">Divorced</label>
                                    </div>
                                </div>
        
                                <div class="form-group row my-1">
                                    <label for="citizenship" class="col-md-4 col-form-label text-md-right fw-bold required">{{ __('Citizenship') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="citizenship" type="text" class="form-control @error('citizenship') is-invalid @enderror" name="citizenship" value="{{ $user->citizenship }}" placeholder="Enter Citizenship..." required autocomplete="citizenship">
                                        @error('citizenship')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('The citizenship must be letters only') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
        
                                <div class="form-group row my-1">
                                    <div class="col-md-6 offset-md-4 ">
                                        <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-primary">
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
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="float-start">
                        <h2>Edit Profile</h2>
                    </div>
                    <div class="float-end">
                      <a class="btn btn-dark fw-bold" href="{{ route('home') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" style="width: 400px;">
                <div class="card">
                  <div style="background-color: maroon;" class="card-header text-light"><b>Profile Picture</b></div>
                      <div class="card-body">
                        <p class="text-center"><img src="{{ asset('images/users/'.$user->profilePath) }}" style="height: 288px; width: auto;"></p>
                        <hr>
                        <p class="card-text"><b>Name: </b>{{ $user->firstName. ' ' .$user->lastName }}</p>
                        <p class="card-text"><b>Email: </b>{{ $user->email }}</p>
                        <p class="card-text"><b>Contact No: </b>{{ $user->contactNo }}</p>
                      </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-light fw-bold" style="background-color: maroon">{{ __('Edit Account Details') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <div class="form-group row my-1">
                                <label for="Image" class="col-sm-4 col-form-label text-md-right  fw-bold">{{ __('Profile Picture (2x2)') }}</label>
                                
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
                                <label for="lastName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Last Name *') }}</label>
                                
                                <div class="col-md-6">
                                    <input @role('Admin') readonly @endrole id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{$user->lastName }}" placeholder="Enter Last Name..." required autocomplete="lastName">
                                    
                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The last name must be letters only') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('First Name *') }}</label>
                                
                                <div class="col-md-6">
                                    <input @role('Admin') readonly @endrole id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $user->firstName }}" placeholder="Enter First Name..." required autocomplete="firstName">
                                    
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The first name must be letters only') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="middleName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Middle Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input @role('Admin') readonly @endrole id="middleName" type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ $user->middleName }}" placeholder="Enter Middle Name..." autocomplete="middleName">
                                    
                                    @error('middleName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The middle name must be letters only') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="email" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('E-Mail Address *') }}</label>
                                
                                <div class="col-md-6">
                                    <input disabled id="email" placeholder="example@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Enter Email Address..." required autocomplete="email">
                                    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="contactNo" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Contact Number *') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="contactNo" type="tel" pattern="[0-9]{10}" placeholder="9123456789" class="form-control @error('contactNo') is-invalid @enderror" name="contactNo" value="{{ $user->contactNo }}" placeholder="Enter Contact No..." required autocomplete="contactNo">
                                    
                                    @error('contactNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="houseNo" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('House Number *') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="houseNo" type="text" class="form-control @error('houseNo') is-invalid @enderror" name="houseNo" value="{{ $user->houseNo }}" placeholder="Enter House No..." required autocomplete="houseNo">
                                    
                                    @error('houseNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="street" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Street *') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $user->street }}" placeholder="Enter Street..." required autocomplete="street">
                                    
                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="dob" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Date of birth *') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="dob" type="date" max='2003-12-31' data-date-format="YYYY MM DD" class="form-control  @error('dob') is-invalid @enderror" name="dob" value="{{ $user->dob }}" required autocomplete="dob">
                                    
          
                                </div> 
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="civilStatus" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Civil Status *') }}</label>
                                
                                <div class="col-md-6">
                 
                                      <input {{ $user->civilStatus == "Single" ? 'checked' : '' }} id="civilStatus" type="radio" value="Single" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Single" required autocomplete="civilStatus">
                                      <label for="Single">Single</label>
                                    
                                      <input {{ $user->civilStatus == "Married" ? 'checked' : '' }} id="civilStatus" type="radio" value="Married" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Married" required autocomplete="civilStatus">
                                      <label for="Married">Married</label>
                                    
                                      <input {{ $user->civilStatus == "Widowed" ? 'checked' : '' }} id="civilStatus" type="radio" value="Widowed" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Widowed" required autocomplete="civilStatus">
                                      <label for="Widowed">Widowed</label>
    
                                      <input {{ $user->civilStatus == "Divorced" ? 'checked' : '' }} id="civilStatus" type="radio" value="Divorced" class=" @error('civilStatus') is-invalid @enderror" name="civilStatus" value="Divorced" required autocomplete="civilStatus">
                                      <label for="Divorce">Divorced</label>
                                </div>
                            </div>
    
                            <div class="form-group row my-1">
                                <label for="citizenship" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Citizenship') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="citizenship" type="text" class="form-control @error('citizenship') is-invalid @enderror" name="citizenship" value="{{ $user->citizenship }}" placeholder="Enter Citizenship..." required autocomplete="citizenship">
                                    @error('citizenship')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The citizenship must be letters only') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            
    
                            <div class="form-group row my-1">
                                <div class="col-md-6 offset-md-4 ">
                                    <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success fw-bold">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
    
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-layout>


