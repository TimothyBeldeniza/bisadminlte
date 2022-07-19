<x-layout>
   <style>
      .required:after {
      content:" *";
      color: red;
     }
</style>
  @section('title', 'Create Document Types')
  <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0">Create Document Type</h1>
       </div><!-- /.col -->
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
           <li class="breadcrumb-item"><a href="{{ route('doctypes.index') }}">Document Types</a></li>
           <li class="breadcrumb-item active">Create Document Types</li>
         </ol>
       </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
  </div>
  <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-3">
               <div class="card">
                  <div class="card-header text-dark font-weight-bold" style="background-color: #f6f7cd;">{{ __('Legend') }}</div>
                  <div class="card-body">
                     <ul>
                        <li><p><b>&lt;&lt;lastName&gt;&gt;</b> - Resident's Last Name</p></li>
                        <li><p><b>&lt;&lt;firstName&gt;&gt;</b> - Resident's First Name</p></li>
                        <li><p><b>&lt;&lt;civilStatus&gt;&gt;</b> - Resident's Civil Status</p></li>
                        <li><p><b>&lt;&lt;citizenship&gt;&gt;</b> - Resident's Citizenhship</p></li>
                        <li><p><b>&lt;&lt;houseNo&gt;&gt;</b> - Resident's House Number</p></li>
                        <li><p><b>&lt;&lt;street&gt;&gt;</b> - Resident's Street</p></li>
                        <li><p><b>&lt;&lt;purpose&gt;&gt;</b> - Document Purpose</p></li>
                        <li><p><b>&lt;&lt;brgy&gt;&gt;</b> - Barangay Name</p></li>
                        <li><p><b>&lt;&lt;city&gt;&gt;</b> - Barangay's City</p></li>
                        <li><p><b>&lt;&lt;province&gt;&gt;</b> - Barangay's Province</p></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-9">
               <div class="card">
                  <div class="card-header text-dark font-weight-bold" style="background-color: #f6f7cd;">{{ __('Document Type Form') }}</div>
                  <div class="card-body">
                     <form method="POST" action="{{ route('doctypes.store') }}">
                        {{-- @method('POST') --}}
                        @csrf
                        <div class="form-group my-1">
                           <label for="Image" class="required font-weight-bold">{{ __('Document Title') }}</label>
                           <input type="text" class="form-control" name="docType" placeholder="Enter Document title here..." required>
                        </div>
                        <div class="form-group my-1">
                        <label for="Image" class="required font-weight-bold">{{ __('Document Content') }}</label>
                           {{-- <textarea class="form-control" name="template" id="summernote"></textarea> --}}
                           <textarea maxlength="715" id="template" class="form-control" rows="10" name="template" placeholder="Example: 
This is to certify that <<lastName>>, <<firstName>>, of legal age, <<civilStatus>>, <<citizenship>> citizen, and resident of <<houseNo>>, <<street>>, <<brgy>>, <<city>>, <<province>>.

Further, certify that the above-named person belongs to the Indigent Family in this Barangay.
                                      
This certification is being issued upon the request of the interested party connection with the requirement for whatever legal purposes that may serve them best, in this case, it is a <<purpose>> requirement." required></textarea>
                        <div id="counter"></div>
                        </div>
                        <div class="form-group my-1">
                        <label for="price" class="required font-weight-bold">{{ __('Document Price') }}</label>
                           <input type="number" class="form-control" step="1" min="0" max="100" name="price" placeholder="ex. 50" required> 
                        </div>
                        <div class="form-group my-1">
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                  </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
  </div>
  <script>
      const messageEle = document.getElementById('template');
      const counterEle = document.getElementById('counter');

      messageEle.addEventListener('input', function (e) {
         const target = e.target;

         // Get the `maxlength` attribute
         const maxLength = target.getAttribute('maxlength');

         // Count the current number of characters
         const currentLength = target.value.length;

         counterEle.innerHTML = `${currentLength}/${maxLength} Characters`;
      });
  </script>
</x-layout> 