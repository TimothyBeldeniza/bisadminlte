<x-layout>
@section('title', 'Edit Officials')
<style>
    .required:after {
      content:" *";
      color: red;
    }
  </style>

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Officials</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('officials.index') }}">Officials</a></li>
            <li class="breadcrumb-item active">Edit Official</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>



  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Profile</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><img src="{{ url('images/officials/'.$officials->imagePath) }}" style="height: 235px; width: auto;"></p>
                        <p class="text-center card-text"> <b>{{ $officials->position . ' ' . $officials->firstName . ' ' . $officials->lastName}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                    <h3 class="card-title">Edit Official</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('officials.update', $officials->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 
        
                            <div class="row">
                                <div class="col">
                                    <label>Profile Picture</label>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="input-group col mb-3">
        
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Choose File">
        
                                    @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="required">Last Name</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group col mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
        
                                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ $officials->lastName }}" required placeholder="Last Name">
                                    
                                    @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="required">First Name</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group col mb-3">
        
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                                    </div>
                                    
                                    <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $officials->firstName }}" required placeholder="First Name">
        
                                    @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="required">Middle Name</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-group col mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                                    </div>
        
                                    <input type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ $officials->middleName }}" placeholder="Middle Name">
                                    
                                    @error('middleName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center input-group col mb-3">
                                    <div>
                                        <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success fw-bold">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
        
        
                        </form>
                    
                    </div>
                    <!-- /.card-body -->    
                    
                </div>
            </div>
        </div>

    </div>  
</div>
<!-- /.card -->

  {{-- <div class="content">
    <div class="container-fluid">
        
            <div class="col-md-8">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="float-left">
                            
                        </div>
                        <div class="float-right">
                            <a class="btn btn-dark text-light fw-bold" href="{{ route('officials.index') }}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card">
    
                    <div class="card-header text-light fw-bold" style="background-color: maroon">{{ __('Edit Officials') }}</div>
        
                    <div class="card-body">
    
                        <form method="POST" action="{{ route('officials.update', $officials->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 
                            <div class="form-group row my-1">
                                <label for="Image" class="col-sm-4 col-form-label text-md-right fw-bold">{{ __('Image') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="file" @error('image') is-invalid @enderror name="image">
                                    
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row my-1">
                                <label for="lastName" class="col-sm-4 col-form-label text-md-right fw-bold">{{ __('Last Name*') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ $officials->lastName }}" placeholder="Enter Laste Name here.." required autocomplete="lastName" autofocus>
                                    
                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('First Name*') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $officials->firstName }}" placeholder="Enter First Name here.." required autocomplete="firstName" autofocus>
                                    
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <label for="middleName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Middle Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="middleName" type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ $officials->middleName }}" placeholder="Enter Middle Name here.." autocomplete="middleName" autofocus>
                                    
                                    @error('middleName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row my-1">
                                <div class="col-md-6 offset-md-4">
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