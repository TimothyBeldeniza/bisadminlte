<x-layout>
   <style>
     .required:after {
     content:" *";
     color: red;
    }
 </style>
 @section('title', 'Walk-in Request Document')
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Walk-in Request Document</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
             <li class="breadcrumb-item active">Walk-in Request Document</li>
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>
 
   <section class="content">
     <div class="container">
        <div class="card">
         <div class="card-header text-dark font-weight-bold" style="background-color: #f6f7cd;">{{ __('Document Request Form') }}</div>
         <div class="card-body">
             <p class="text-danger font-weight-bold">Remember to ask first from the Requestor for a Valid ID!</p>
             <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                 @csrf
                 <div class="form-group row my-1">
                    <div class="col">
                        <label for="user" class="required">{{ __('User') }}</label>
                        <select id="user" name="user" class="form-control select2bs4" onfocus="this.value=''">
                           <option value></option>
                           @foreach ($users as $user) 
                              {{-- @foreach ($hasCases as $x)
                                 @if ($user->id == $x->id)
                                    <option value="{{ $user->id }}" disabled>{{ $user->firstName. ' '. $user->lastName }} (In Unresolved or On Going Cases)</option>
                                 @else
                                    <option value="{{ $user->id }}">{{ $user->firstName. ' '. $user->lastName }}</option>
                                 @endif
                              @endforeach    --}}
                              <option value="{{ $user->id }}">{{ $user->firstName. ' '. $user->lastName }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <p>This includes information about the user specifically the: <br> <b>Last Name, First Name, Middle Name,</b> <br> <b>Citizenship, Civil Status, Address</b> </p>
                    </div>
                 </div>
                 <hr>
                 <div class="form-group row my-1">
                  <div class="col-sm">
                     <label class="required" for="docType">{{ __('Document Type') }}</label>
                     <select class="form-control" name="docType" id="docType" required>
                        <option value>--Select Document Type--</option>
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
                 <div class="form-group py-1">
                     <div class="float-right ">
                         <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-primary" >
                             {{ __('Submit') }}
                         </button>
                     </div>
                 </div>
             </form>
         </div>
       </div>
     </div>
   </div>
   @section('custom-scripts')
     <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
     <script>
       $(function () {
         //Initialize Select2 Elements
         $('.select2bs4').select2({
           placeholder: 'Select User',
           theme: 'bootstrap4',
         })
       })

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
   @endsection
 </x-layout>
 
 