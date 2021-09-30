<x-layout>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="float-start">
                            <h2>Request Documents</h2>
                        </div>
                        <div class="float-end">
                            <a class="btn btn-dark fw-bold" href="{{ route('home') }}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-light fw-bold" style="background-color: maroon;">{{ __('Document Request Form') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row my-1">
                                <label for="Image" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Barangay ID') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="file"  class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('lastName') }}">
                                    
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-1">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Last Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input readonly="true" id="lastName" type="text" class="form-control" name="lastName" value="{{ Auth::user()->lastName }}">
                                </div>
                            </div>

                            <div class="form-group row my-1">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('First Name') }}</label>
                                
                                <div class="col-md-6">
                                    <input readonly="true" id="firstName" type="text" class="form-control" name="firstName" value="{{ Auth::user()->firstName }}">
                                </div>
                            </div>

                            @if(!empty(Auth::User()->middleName))
                                <div class="form-group row my-1">
                                    <label for="middleName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Middle Name') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input readonly="true" readonly="true" id="middleName" type="text" class="form-control" name="middleName" value="{{ Auth::user()->middleName }}">
                                    </div>
                                </div>
                            @else
                                <div class="form-group row my-1">
                                    <label for="middleName" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('No Middle Name') }}</label>
                                </div>
                            @endif

                            <div class="form-group row my-1">
                                <label for="houseNo" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('House Number') }}</label>
                                
                                <div class="col-md-6">
                                    <input readonly="true" id="houseNo" type="text" class="form-control" name="houseNo" value="{{ Auth::user()->houseNo }}">
                                </div>
                            </div>
                            <div class="form-group row my-1">
                                <label for="street" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Street') }}</label>
                                
                                <div class="col-md-6">
                                    <input readonly="true" id="street" type="text" class="form-control" name="street" value="{{ Auth::user()->street }}">
                                </div>
                            </div>

                            <div class="form-group row my-1">
                                <label for="civilStatus" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Civil Status') }}</label>
                                <div class="col-md-6">
                                    <input readonly="true" id="civilStatus" type="text" class="form-control" name="civilStatus" value="{{ Auth::user()->civilStatus }}">
                                </div>
                            </div>

                            <div class="form-group row my-1">
                                <label for="citizenship" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Citizenship') }}</label>
                                
                                <div class="col-md-6">
                                    <input readonly="true" id="citizenship" type="text" class="form-control" name="city" value="{{ Auth::user()->citizenship }}">
                                </div>
                            </div>

                            <div class="form-group row my-1">
                                <label for="docType" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Document Type *') }}</label>
                                
                                <div class="col-md-6">
                                    <select class="form-select" name="docType" id="docType" required>
                                            <option value>--Select Document Type--</option>
                                    @foreach ($doctypes as $doctype) 
                                            <option value="{{ $doctype->id }}">{{ $doctype->docType }} - ₱{{ $doctype->price }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row my-1">
                                <label for="purpose" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Purpose *') }}</label>
                                
                                <div class="col-md-6">
                                    <select class="form-select" name="purpose" id="purpose" onchange="showDiv('others', this)" required>
                                        <option value>--Select Purpose--</option>
                                        <option>Personal Identification and Residence Status</option>
                                        <option>Good Standing in the Community</option>
                                        <option>No pending case filed in the barangay</option>
                                        <option>Employment (Local)</option>
                                        <option>Employment (Abroad)</option>
                                        <option>Enrollment</option>
                                        <option>Scholarship</option>
                                        <option>Senior Citizens & Solo Parent</option>
                                        <option>Marriage (Local)</option>
                                        <option>Marriage (Abroad)</option>
                                        <option>Construction Permit</option>
                                        <option>Construction Excavaion Permit</option>
                                        <option value="others">Other Purpose</option>
                                    </select>
                                    <div class="my-1" id="others" style="display: none">
                                      <input type="text" class="form-control" name="others" placeholder="Enter Other Purpose...">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row my-1">
                                <div class="col-md-6 offset-md-4">
                                    <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success fw-bold" >
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
    <script>
      function showDiv(divId, element)
      {
          document.getElementById(divId).style.display = element.value == "others" ? 'block' : 'none';
      } 
    </script> --}}
    @section('title', 'Request Document')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Request Document</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Request Document</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container">
            <div class="card card-info">
                <div class="card-header" style="background-color: maroon;">
                  <h3 class="card-title font-weight-bold">Document Request Form</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="image">Barangay ID*</label>
                        <div class="form-group mb-3">
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-sm">
                                <label for="lastName">Last Name*</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->lastName }}" name="lastName" id="lastName" required>
                            </div>
                            
                            <div class="col-sm">
                                <label for="firstName">First Name*</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->firstName }}" name="firstName" id="firstName" required>
                            </div>

                            <div class="col-sm">
                                <label for="middleName">Middle Name*</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->middleName }}" name="middleName" id="middleName" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <div class="col-sm">
                                <label for="citizenship">Citizenship*</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->citizenship }}" name="citizenship" id="citizenship" required>
                            </div>
                            <div class="col-sm">
                                <label for="houseNo">House Number*</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->houseNo }}" name="houseNo" id="houseNo" required>
                            </div>
                            <div class="col-sm">
                                <label for="street">Street*</label>
                                <input readonly type="text" class="form-control" value="{{ Auth::user()->street }}" name="street" id="street" required>
                            </div>
                        </div>

                        <div class="form-group row my-1">
                            <label for="docType" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Document Type *') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-select" name="docType" id="docType" required>
                                        <option value>--Select Document Type--</option>
                                @foreach ($doctypes as $doctype) 
                                        <option value="{{ $doctype->id }}">{{ $doctype->docType }} - ₱{{ $doctype->price }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row my-1">
                            <label for="purpose" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Purpose *') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-select" name="purpose" id="purpose" onchange="showDiv('others', this)" required>
                                    <option value>--Select Purpose--</option>
                                    <option>Personal Identification and Residence Status</option>
                                    <option>Good Standing in the Community</option>
                                    <option>No pending case filed in the barangay</option>
                                    <option>Employment (Local)</option>
                                    <option>Employment (Abroad)</option>
                                    <option>Enrollment</option>
                                    <option>Scholarship</option>
                                    <option>Senior Citizens & Solo Parent</option>
                                    <option>Marriage (Local)</option>
                                    <option>Marriage (Abroad)</option>
                                    <option>Construction Permit</option>
                                    <option>Construction Excavaion Permit</option>
                                    <option value="others">Other Purpose</option>
                                </select>
                                <div class="my-1" id="others" style="display: none">
                                  <input type="text" class="form-control" name="others" placeholder="Enter Other Purpose...">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-1">
                            <div class="col-md-6 offset-md-4">
                                <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success fw-bold" >
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>     
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</x-layout>
    