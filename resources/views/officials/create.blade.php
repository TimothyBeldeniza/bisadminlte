<x-layout>
    @section('title', 'Register Official')

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Officials</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Officials</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Add Officials</h3>
                </div>
                <div class="card-body">
                  {{-- <h4>With icons</h4> --}}
                    <form method="POST" action="{{ route('officials.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           
                            {{-- <label class="font-weight-bold">Image</label> --}}
                            
                            <div class="input-group col mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                </div>
                                
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required placeholder="Choose File">

                                @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                   
                      
                            {{-- <label class="font-weight-bold">Last Name</label> --}}
                            <div class="input-group col mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>

                                <input type="text" class="form-control @error('image') is-invalid @enderror" name="lastName" required placeholder="Last Name">
                                
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- <label class="font-weight-bold">First Name</label> --}}
                            <div class="input-group col mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                                </div>
                                
                                <input type="text" class="form-control @error('image') is-invalid @enderror" name="firstName" required placeholder="First Name">

                                @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                   
                      
                            {{-- <label class="font-weight-bold">Middle Name</label> --}}
                            <div class="input-group col mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                                </div>

                                <input type="text" class="form-control @error('image') is-invalid @enderror" placeholder="Middle Name">
                                
                                @error('middleName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            
                        </div>

                            <div class="col-md-4">
                              <!-- select -->
                              <div class="form-group">
                                <label>Position</label>
                                <select class="custom-select" name="position" id="position" required>
                                    <option value="" selected>--Choose Position--</option>
                                    <option @if($officials['cm'] == 1) return disabled @endif>Chairman</option>
                                    <option @if($officials['coun'] == 7) return disabled @endif>Councilor</option>
                                    <option @if($officials['sk'] == 1) return disabled @endif>SK Chairman</option>
                                    <option @if($officials['sec'] == 1) return disabled @endif>Secretary</option>
                                    <option @if($officials['tre'] == 1) return disabled @endif>Treasurer</option>
                                </select>
                              </div>
                            </div>
                        
                        

                    </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
    </div>



    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="float-start">
                        <h2>Add Official</h2>
                    </div>
                    <div class="float-end">
                        <a class="btn btn-dark text-light fw-bold" href="{{ route('officials.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-header text-light fw-bold" style="background-color: maroon">{{ __('Create Officials') }}</div>
    
                    <div class="card-body">

                    <form method="POST" action="{{ route('officials.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row my-1">
                            <label for="Image" class="col-sm-4 col-form-label text-md-right fw-bold">{{ __('Image*') }}</label>
                            
                            <div class="col-md-6">
                                <input type="file"  class="form-control @error('image') is-invalid @enderror" name="image" required>
                                
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
                                <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" placeholder="Enter Last Name here.." required autocomplete="lastName" autofocus>
                                
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
                                <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" placeholder="Enter First Name here.." required autocomplete="firstName" autofocus>
                                
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
                                <input id="middleName" type="text" class="form-control @error('middleName') is-invalid @enderror" name="middleName" value="{{ old('middleName') }}" placeholder="Enter Middle Name here.." autocomplete="middleName" autofocus>
                                
                                @error('middleName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row my-1">
                            <label for="position" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Position*') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-select" name="position" id="position" required>
                                    <option value="" selected>--Choose Position--</option>
                                    <option @if($officials['cm'] == 1) return disabled @endif>Chairman</option>
                                    <option @if($officials['coun'] == 7) return disabled @endif>Councilor</option>
                                    <option @if($officials['sk'] == 1) return disabled @endif>SK Chairman</option>
                                    <option @if($officials['sec'] == 1) return disabled @endif>Secretary</option>
                                    <option @if($officials['tre'] == 1) return disabled @endif>Treasurer</option>
                                </select>
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
</x-layout>
