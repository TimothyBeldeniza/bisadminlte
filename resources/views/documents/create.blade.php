<x-layout>

   <style>
         .required:after {
         content:" *";
         color: red;
        }
   </style>
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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Request Document</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container">
           @if ($hasCase == true)
              <div class="card">
               <div style="font-size: 130%" class="card-header text-light font-weight-bold bg-danger"><i class="fas fa-exclamation-circle"></i> Warning</div>
                  <div class="card-body">
                     <p class="card-text" style="font-size: 130%">You, <b>{{ Auth::user()->firstName.' '.Auth::user()->lastName }}</b> have <b class="text-danger">Unresolved</b> or <b class="text-danger">On Going</b> cases. </p>
                     <p class="card-text" style="font-size: 130%">Please get them processed to be able to Request Documents once again.</p>
                     <button class="btn btn-primary float-right" onclick="history.back()">Back</button>
                  </div>
              </div>
           @elseif ($hasCase == false)
           <div class="row">
              
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-header font-weight-bold text-dark" style="background-color: #f6f7cd;">Note:</div>
                     <div class="card-body">
                        <p class="card-text text-danger font-weight-bold">If any of your details have changed recently, go to the "Edit Profile" tab to change them before requesting a document.</p>
                     </div>
                  </div>
               </div>

               <div class="col-md-9">
                  <div class="card">
                     <div class="card-header font-weight-bold text-dark" style="background-color: #f6f7cd;">Document Request Form</div>
                     <div class="card-body">
                        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                           @csrf
                           <label class="required" for="image">Valid ID</label>
                           <div class="form-group mb-3">
                                 <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>
                                 <span><b class="text-danger">Image must be .jpg / .jpeg / .png</b></span>
                                 @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                           </div>
                           <div class="form-group row mb-3">
                                 <div class="col-sm">
                                    <label class="required" for="lastName">Last Name</label>
                                    <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->lastName }}" name="lastName" id="lastName" required>
                                 </div>
                                 
                                 <div class="col-sm">
                                    <label class="required" for="firstName">First Name</label>
                                    <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->firstName }}" name="firstName" id="firstName" required>
                                 </div>
      
                                 <div class="col-sm">
                                    <label for="middleName">Middle Name</label>
                                    @if (Auth::user()->middleName != null)                                  
                                       <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->middleName }}" name="middleName" id="middleName" required>
                                    @else
                                       <input readonly type="text" class="form-control font-weight-bold" value="None" name="middleName" id="middleName" required>
                                    @endif
                                 </div>
                           </div>
                           
                           <div class="form-group row mb-3">
                                 <div class="col-sm">
                                    <label class="required" for="citizenship">Citizenship</label>
                                    <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->citizenship }}" name="citizenship" id="citizenship" required>
                                 </div>
                                 <div class="col-sm">
                                    <label class="required" for="houseNo">House Number</label>
                                    <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->houseNo }}" name="houseNo" id="houseNo" required>
                                 </div>
                                 <div class="col-sm">
                                    <label class="required" for="street">Street</label>
                                    <input readonly type="text" class="form-control font-weight-bold" value="{{ Auth::user()->street }}" name="street" id="street" required>
                                 </div>
                           </div>
                           
                           <div class="form-group row my-1">
                              <div class="col-sm">
                                 <label class="required" for="docType">{{ __('Document Type') }}</label>
                                 <select class="form-control text-uppercase" name="docType" id="docType" required>
                                    <option selected disabled>--Select Document Type--</option>
                                 @foreach ($doctypes as $doctype) 
                                    <option value="{{ $doctype->id }}">{{ $doctype->docType }} - ₱{{ $doctype->price }}</option>
                                 @endforeach
                                 </select>
                              </div>
                              <div class="col-sm">
                                 <label class="required" for="purpose">{{ __('Purpose') }}</label>
                                 <select class="form-control" name="purpose" id="purpose" onchange="showOther()" required>
                                    <option selected disabled>--SELECT PURPOSE--</option>
                                    <option>PERSONAL IDENTIFICATION AND RESIDENCE STATUS</option>
                                    <option>GOOD STANDING IN THE COMMUNITY</option>
                                    <option>NO PENDING CASE FILED IN THE BARANGAY</option>
                                    <option>EMPLOYMENT (LOCAL)</option>
                                    <option>EMPLOYMENT (ABROAD)</option>
                                    <option>ENROLLMENT</option>
                                    <option>SCHOLARSHIP</option>
                                    <option>SENIOR CITIZENS & SOLO PARENT</option>
                                    <option>MARRIAGE (LOCAL)</option>
                                    <option>MARRIAGE (ABROAD)</option>
                                    <option>CONSTRUCTION PERMIT</option>
                                    <option>CONSTRUCTION EXCAVAION PERMIT</option>
                                    <option>OTHER PURPOSE</option>
                                 </select>
                              </div>
                              <div class="col-sm" id="others">
                                 <label id="othersLabel" for="others">Enter Other Purpose</label>
                                 <input id="othersInput" type="text" class="form-control  @error('others') is-invalid @enderror" onkeyup="this.value = this.value.toUpperCase();" name="others" placeholder="Enter Other Purpose..." disabled>
                                 @error('others')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>
      
                           <div class="form-group float-right my-3">
                              <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-primary font-weight-bold" >
                                 {{ __('Submit') }}
                              </button>
                           </div>
                        </form>     
                     </div>
                  </div>
               </div>

           </div>
           @endif
        </div>
    </div>
    <script>
      function showOther()
      {
         if(document.getElementById("purpose").value == "OTHER PURPOSE")
         {
            document.getElementById("othersLabel").classList.add('required');
            document.getElementById('othersInput').removeAttribute("disabled");
            document.getElementById('othersInput').setAttribute("required", "");
         }
         else
         {
            document.getElementById("othersLabel").classList.remove('required');
            document.getElementById('othersInput').setAttribute("disabled", "");
            document.getElementById('othersInput').removeAttribute("required");
         }
      }  
    </script>
</x-layout>
    