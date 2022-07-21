<x-layout>
  <style>
    .required:after {
    content:" *";
    color: red;
   }
</style>
  @section('title', 'Record Complaint')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Record Complaint</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Record Complaint</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container">
       <div class="card">
        <div class="card-header text-dark font-weight-bold" style="background-color: #f6f7cd;">{{ __('Complaint Form') }}</div>
        <div class="card-body">
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
          @endif
            <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                @csrf
                <b class="required">Complainant</b><br>
                <div class="d-flex">
                  <div class="pr-3">
                     <input type="radio" id="insideC" name="fromC" value="insideC" onclick="showComplainant()" required>
                     <label>Residential</label>
                  </div>
                  <div class="pr-3">
                     <input type="radio" id="outsideC" name="fromC" value="outsideC" onclick="showComplainant()" required>
                     <label>Non-Residential</label>
                  </div>
                </div>

                <div id="complainant" style="display: none">
                  <b>Inside</b><br>
                  <div class="form-group row my-1">
                      <label for="complainantId" class="col-md-4 col-form-label required">{{ __('Complainant Name') }}</label>
                      <div class="col-md-6">
                          <select id="complainantId" name="complainantId" class="form-control select2bs4">                           
                          @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->firstName. ' '. $user->lastName }}</option>
                          @endforeach
                          </select>
                      </div>
                  </div>
                </div>

                <div id="otherComplainant" style="display: none">
                    <b class="required">Outside</b><br>
                    <div class="form-group row my-1">
                       <div class="col-sm">
                           <label class="required" for="name">{{ __('Complainant Full Name') }}</label>
                           <input id="cName" type="text" class="form-control" @error('cName') is-invalid @enderror name="cName" id="cName" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Complainant Full Name..." pattern="[a-zA-Z\s]+">
                           @error('cName')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                       </div>
                       <div class="col-sm">
                           <label class="required" for="cContact">{{ __('Complainant Number') }}</label>
                           <input id="cContact" type="text" class="form-control" @error('cContact') is-invalid @enderror name="cContact" id="cContact" placeholder="09123456789" pattern="[0-9]{11}">
                           @error('cContact')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                       <div class="col-sm">
                           <label class="required" for="cAddress">{{ __('Complainant Address') }}</label>
                           <textarea class="form-control" name="cAddress" id="cAddress" cols="30" rows="3" id="cAddress" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Complainant's Address here..."></textarea>
                       </div>
                    </div>
                </div>
                    
                <hr>
                <b class="required">Respondents</b><br>
                <input type="radio" id="insideR" name="fromR" value="insideR" onclick="showRespondent()" required>
                <label>Residential</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="outsideR" name="fromR" value="outsideR" onclick="showRespondent()" required>
                <label>Non-Residential</label>

                <div id="respondent" style="display: none">
                  <b>Inside</b><br>
                  <div class="form-group row my-1">
                      <label for="respondentId" class="col-md-4 col-form-label required">{{ __('Respondent Name') }}</label>
                      <div class="col-md-6">
                          <select id="respondentId" name="respondentId" class="form-control select2bs4">
                          @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->firstName. ' '. $user->lastName }}</option>
                          @endforeach
                          </select>
                      </div>
                  </div>
                </div>

                <div id="otherRespondent" style="display: none">
                  <div class="form-group row my-1">
                     <div class="col-sm">
                        <label for="respondents" class="required">{{ __('Respondent Name') }}</label>
                        <input id="respondents" type="text" class="form-control" @error('respondents') is-invalid @enderror onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Respondent Full Name here..." name="respondents" pattern="[a-zA-Z\s]+">
                        @error('respondents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                     <div class="col-sm">
                        <label for="respondents">{{ __('Respondent Contact Number') }}</label>
                        <input id="respondentsContact" type="text" class="form-control" @error('respondentsContact') is-invalid @enderror placeholder="09123456789" name="respondentsContact" pattern="[0-9]{11}">
                        @error('respondentsContact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                     <div class="col-sm">
                        <label for="respondentsAdd" class="required">{{ __("Respondents Address") }}</label>
                        <textarea class="form-control" name="respondentsAdd" id="respondentsAdd" cols="30" rows="3" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter Respondent's Address here..."></textarea>
                     </div>
                  </div>
                </div>
                
                <hr>
                <div class="form-group my-1">
                   <label class="required" for="hearing_date">{{ __('Hearing Date') }}</label>
                   <input type="date" class="form-control" name="hearing_date" id="hearing_date" required>
                </div>
                <div class="form-group my-1">
                     <label class="required" for="complainDetails">{{ __('Complaint Details') }}</label>
                     <textarea class="form-control" placeholder="Enter details here..." name="compDetails" id="compDetails" cols="30" rows="3" required></textarea>
                </div>
                <div class="form-group row my-1">
                </div>
                
                <div class="form-group py-1">
                    <div class="float-right ">
                        <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-primary font-weight-bold">
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
        $('select').select2({
          placeholder: 'Select User',
          theme: 'bootstrap4',
        })
      })

      function showComplainant() {
         if (document.getElementById('insideC').checked) 
         {
               document.getElementById('complainant').style.display = 'block';
               document.getElementById('otherComplainant').style.display = 'none';
               document.getElementById('outsideR').disabled = false;
               document.getElementById('complainantId').setAttribute("required", "");
               document.getElementById('cName').removeAttribute("required", "");
               document.getElementById('cContact').removeAttribute("required", "");
               document.getElementById('cAddress').removeAttribute("required", "");
               document.getElementById('cName').value = "";
               document.getElementById('cAddress').value = "";
               document.getElementById('cContact').value = "";
               $("#complainantId").val(null).trigger('change');
         }
         else if (document.getElementById('outsideC').checked) 
         {
               document.getElementById('otherComplainant').style.display = 'block';
               document.getElementById('complainant').style.display = 'none';
               document.getElementById('outsideR').disabled = true;
               document.getElementById('complainantId').removeAttribute("required", "");
               document.getElementById('cName').setAttribute("required", "");
               document.getElementById('cContact').setAttribute("required", "");
               document.getElementById('cAddress').setAttribute("required", "");
               $("#complainantId").val(null).trigger('change');
         }
       }  
       function showRespondent() {
            if (document.getElementById('insideR').checked) 
            {
               document.getElementById('respondent').style.display = 'block';
               document.getElementById('otherRespondent').style.display = 'none';
               document.getElementById('outsideC').disabled = false;
               //  $("#respondentId").attr('required', '');
               //  $("#respondents").val('');
               //  $("#respondentsAdd").val('');
               //  $("#respondentsContact").val('');
               document.getElementById('respondentId').setAttribute("required", "");
               document.getElementById('respondents').removeAttribute("required", "");
               document.getElementById('respondentsAdd').removeAttribute("required", "");
               document.getElementById('respondentsContact').removeAttribute("required", "");
               document.getElementById('respondents').value = "";
               document.getElementById('respondentsAdd').value = "";
               document.getElementById('respondentsContact').value = "";
               $("#respondentId").val(null).trigger('change');
            }
            else if (document.getElementById('outsideR').checked) 
            {
               document.getElementById('otherRespondent').style.display = 'block';
               document.getElementById('respondent').style.display = 'none';
               document.getElementById('outsideC').disabled = true;
               document.getElementById('respondentId').removeAttribute("required", "");
               document.getElementById('respondents').setAttribute("required", "");
               document.getElementById('respondentsAdd').setAttribute("required", "");
               $("#respondentId").val(null).trigger('change');
            }
       }  
       function preventDupes( select, index ) {
            var options = select.options,
               len = options.length;
            while( len-- ) {
               options[ len ].disabled = false;
            }
            select.options[ index ].disabled = true;
        }

         var select1 = select = document.getElementById( 'complainantId' );
         var select2 = select = document.getElementById( 'respondentId' );

         select1.onchange = function() {
            preventDupes.call(this, select2, this.selectedIndex );
         };

         select2.onchange = function() {
            preventDupes.call(this, select1, this.selectedIndex );
         };
    </script>
  @endsection
</x-layout>

