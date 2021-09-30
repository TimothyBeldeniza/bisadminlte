<x-layout>
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
            <div class="card">
                <div class="card-header font-weight-bold text-light" style="background-color: maroon;">Document Request Form</div>
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
                                <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->lastName }}" name="lastName" id="lastName" required>
                            </div>
                            
                            <div class="col-sm">
                                <label for="firstName">First Name*</label>
                                <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->firstName }}" name="firstName" id="firstName" required>
                            </div>

                            <div class="col-sm">
                                <label for="middleName">Middle Name*</label>
                                @if (Auth::user()->middleName != null)                                  
                                  <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->middleName }}" name="middleName" id="middleName" required>
                                @else
                                  <input readonly type="text" class="form-control font-weight-bold" value="None" name="middleName" id="middleName" required>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <div class="col-sm">
                                <label for="citizenship">Citizenship*</label>
                                <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->citizenship }}" name="citizenship" id="citizenship" required>
                            </div>
                            <div class="col-sm">
                                <label for="houseNo">House Number*</label>
                                <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->houseNo }}" name="houseNo" id="houseNo" required>
                            </div>
                            <div class="col-sm">
                                <label for="street">Street*</label>
                                <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->street }}" name="street" id="street" required>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="form-group row mb-3">
                          <div class="col-sm">
                              <label for="docType">Document Type</label>
                              <select class="form-control" name="docType" id="docType" required>
                                <option value>--Select Document Type--</option>
                              @foreach ($doctypes as $doctype) 
                                <option value="{{ $doctype->id }}">{{ $doctype->docType }} - ₱{{ $doctype->price }}</option>
                              @endforeach
                              </select>
                          </div>
                          <div class="col-sm">
                              <label for="purpose">Purpose</label>
                              <select class="form-control" name="purpose" id="purpose" onchange="showDiv('others', this)" required>
                                <option value>--Select Purpose--</option>
                                <option>Personal Identification and Residence Status</option>
                                <option>Good Standing in the Community</option>
                                <option>Employment (Local)</option>
                                <option>Employment (Abroad)</option>
                                <option>Enrollment</option>
                                <option>Scholarship</option>
                                <option>Senior Citizens & Solo Parent</option>
                                <option>Marriage (Local)</option>
                                <option>Marriage (Abroad)</option>
                                <option>Construction Permit</option>
                                <option>Construction Excavation Permit</option>
                                <option value="others">Other Purpose</option>
                              </select>
                          </div>
                          <div class="col-sm" id="others" style="display: none">
                            <label for="others">Other Purpose</label>
                            <input type="text" class="form-control" name="others" placeholder="Enter Other Purpose...">
                          </div>
                        </div>
                        <div class="form-group row mb-3 float-right">
                          <div class="col-sm">
                            <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success font-weight-bold" >Submit</button>
                            <button onclick="history.back()" type="button" class="btn btn-dark font-weight-bold" >Back</button>
                          </div>
=======

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
>>>>>>> 51838264c0755275893879a71372a685633bd30d
                        </div>
                    </form>     
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
    <script>
      function showDiv(divId, element)
      {
          document.getElementById(divId).style.display = element.value == "others" ? 'block' : 'none';
      } 
    </script>
</x-layout>
    