<x-layout>
@section('title', 'Edit Officials')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Officials</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Officials</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="content">
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
    
                    <div class="card-header text-light fw-bold" style="background-color: maroon">{{ __('Create Officials') }}</div>
        
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
                        {{-- @if ($errors->any()) 
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                        {{     @endforeach }}
                        @endif --}}
    
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</x-layout>