<x-layout>

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
        <div class="card-header text-light font-weight-bold" style="background-color: maroon;">{{ __('Complaint Form') }}</div>
        <div class="card-body">
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
          @endif
            <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                @csrf
                <b>Complainant</b><br>
                <input type="radio" id="insideC" name="fromC" onclick="showComplainant()" checked>
                <label>Within the barangay</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="outsideC" name="fromC" onclick="showComplainant()">
                <label>Outside the barangay</label>

                <div id="complainant" style="display: block">
                  <b>Inside</b><br>
                  <div class="form-group row my-1">
                      <label for="complainantId" class="col-md-4 col-form-label">{{ __('Complainant Name*') }}</label>
                      <div class="col-md-6">
                          <select id="complainantId" name="complainantId" class="form-control select2bs4" onfocus="this.value=''">
                              <option value>--Select Registered User--</option>
                          @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->firstName. ' '. $user->lastName }}</option>
                          @endforeach
                          </select>
                      </div>
                  </div>
                </div>

                <div id="otherComplainant" style="display: none">
                    <b>Outside</b><br>
                    <div class="form-group row my-1">
                       <div class="col-sm">
                           <label for="name">{{ __('Complainant Full Name*') }}</label>
                           <input id="cName" type="text" class="form-control" @error('cName') is-invalid @enderror name="cName" placeholder="Enter Complainant Full Name..." onfocus="this.value=''">
                           @error('cName')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                       </div>
                       <div class="col-sm">
                           <label for="cAddress">{{ __('Complainant Address*') }}</label>
                           <textarea class="form-control" name="cAddress" id="cAddress" cols="30" rows="3" placeholder="Enter Complainant's Address here..."></textarea>
                       </div>
                    </div>
                </div>
                    
                <hr>
                <b>Respondents</b><br>
                <input type="radio" id="insideR" name="fromR" onclick="showRespondent()" checked>
                <label>Within the barangay</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="outsideR" name="fromR" onclick="showRespondent()">
                <label>Outside the barangay</label>

                <div id="respondent" style="display: block">
                  <b>Inside</b><br>
                  <div class="form-group row my-1">
                      <label for="respondentId" class="col-md-4 col-form-label">{{ __('Respondent Name*') }}</label>
                      <div class="col-md-6">
                          <select id="respondentId" name="respondentId" class="form-control select2bs4" onfocus="this.value=''">
                              <option value>--Select Registered User--</option>
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
                        <label for="respondents" class="col-md-4 col-form-label font-weight-normal">{{ __('Respondent Name') }}</label>
                        <input id="respondents" type="text" class="form-control" @error('respondents') is-invalid @enderror placeholder="Enter Respondent Full Name here..." name="respondents" onfocus="this.value=''">
                        @error('respondents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                     </div>
                     <div class="col-sm">
                        <label for="respondentsAdd" class="col-md-4 col-form-label font-weight-normal">{{ __("Respondents Address*") }}</label>
                        <textarea class="form-control" name="respondentsAdd" id="respondentsAdd" cols="30" rows="3" placeholder="Enter Respondent's Address here..."></textarea>
                     </div>
                  </div>
                </div>
                
                <hr>
                <div class="form-group row my-1">
                   <div class="col-sm">
                     <label for="complainDetails">{{ __('Complaint Details*') }}</label>
                     <textarea class="form-control" placeholder="Enter details here..." name="compDetails" id="compDetails" cols="30" rows="3" required></textarea>
                   </div>
                </div>
                
                <div class="form-group row py-1">
                    <div class="col-sm">
                        <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success" >
                            {{ __('Submit') }}
                        </button>
                        <button onclick="history.back()" type="submit" class="btn btn-dark" >
                            {{ __('Back') }}
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
            }
            else if (document.getElementById('outsideC').checked) 
            {
                document.getElementById('otherComplainant').style.display = 'block';
                document.getElementById('complainant').style.display = 'none';
            }
       }  
       function showRespondent() {
            if (document.getElementById('insideR').checked) 
            {
                document.getElementById('respondent').style.display = 'block';
                document.getElementById('otherRespondent').style.display = 'none';
            }
            else if (document.getElementById('outsideR').checked) 
            {
                document.getElementById('otherRespondent').style.display = 'block';
                document.getElementById('respondent').style.display = 'none';
            }
       }  
    </script>
  @endsection
</x-layout>

