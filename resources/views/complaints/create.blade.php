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
    <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      {{-- <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Select2 (Default Theme)</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Minimal</label>
                <select class="form-control select2bs4" style="width: 100%;">
                  <option selected="selected">--Select User--</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->firstName. ' '. $user->lastName }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
         </div>
       </div> --}}

       <div class="card">
        <div class="card-header text-light fw-bold" style="background-color: maroon;">{{ __('Complaint Form') }}</div>
        <div class="card-body">
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
          @endif
            <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                @csrf
                <b>Complainant</b><br>
                <input type="radio" id="insideC" name="fromC" onclick="showComplainant()">
                <label>Within the barangay</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="outsideC" name="fromC" onclick="showComplainant()">
                <label>Outside the barangay</label>

                <div id="complainant" style="display: none">
                  <b>Inside</b><br>
                  <div class="form-group row my-1">
                      <label for="complainantId" class="col-md-4 col-form-label font-weight-normal">{{ __('Complainant Name') }}</label>
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
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Complainant Full Name*') }}</label>
                        
                        <div class="col-md-6">
                            <input id="cName" type="text" class="form-control" name="cName" placeholder="Enter Complainant Full Name..." onfocus="this.value=''">
                        </div>
                    </div>
                    
                    <div class="form-group row my-1">
                        <label for="cAddress" class="col-md-4 col-form-label text-md-right">{{ __('Complainant Address*') }}</label>
                        
                        <div class="col-md-6">
                          <textarea class="form-control" @error('cAddress') is-invalid @enderror placeholder="Enter Complainant's Address here..." name="cAddress" id="cAddress" cols="30" rows="5" onfocus="this.value=''"></textarea>
                        </div>
                    </div>
                </div>
                    
                <hr>
                <b>Respondents</b><br>
                <input type="radio" id="insideR" name="fromR" onclick="showRespondent()">
                <label>Within the barangay</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" id="outsideR" name="fromR" onclick="showRespondent()">
                <label>Outside the barangay</label>

                <div id="respondent" style="display: none">
                  <b>Inside</b><br>
                  <div class="form-group row my-1">
                      <label for="respondentId" class="col-md-4 col-form-label font-weight-normal">{{ __('Respondent Name') }}</label>
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
                    <label for="respondents" class="col-md-4 col-form-label font-weight-normal">{{ __('Respondent Name') }}</label> 
                    <div class="col-md-6">
                        <input id="respondents" type="text" class="form-control" @error('respondents') is-invalid @enderror placeholder="Enter Respondent Full Name here..." name="respondents" onfocus="this.value=''">
                        @error('respondents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group row my-1">
                    <label for="respondentsAdd" class="col-md-4 col-form-label font-weight-normal">{{ __("Respondents Address*") }}</label>
                    <div class="col-md-6">
                        <textarea class="form-control" @error('respondents') is-invalid @enderror placeholder="Enter Respondent's Address here..." name="respondentsAdd" id="respondentsAdd" cols="30" rows="5" onfocus="this.value=''"></textarea>
                    </div>
                  </div>
                </div>
                
                <hr>
                <div class="form-group row my-1">
                    <label for="complainDetails" class="col-md-4 col-form-label fw-bold">{{ __('Complaint Details') }}</label>
                    
                    <div class="col-md-6">
                        <textarea class="form-control" placeholder="Enter details here..." name="compDetails" id="compDetails" cols="30" rows="5" required></textarea>
                    </div>
                </div>
                
                <div class="form-group row py-1">
                    <div class="col-md-6 offset-md-4 ">
                        <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-success fw-bold" >
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Select2 -->
  
  

  @section('custom-scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
      $(function () {
        // //Initialize Select2 Elements
        // $('.select2').select2()
        
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
      })
    </script>
  @endsection





    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    @section('title', 'File Complaints')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="float-start">
                            <h2>Record Complaint</h2>
                        </div>
                        <div class="float-end">
                            <a class="btn btn-dark fw-bold" href="{{ route('home') }}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-light fw-bold" style="background-color: maroon;">{{ __('Complaint Form') }}</div>
                    <div class="card-body">
                      @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                      @endif
                        <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                            @csrf
                            <b>Complainant</b><br>
                            <input type="radio" id="insideC" name="fromC" onclick="showComplainant()">
                            <label>Within the barangay</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="outsideC" name="fromC" onclick="showComplainant()">
                            <label>Outside the barangay</label>

                            <div id="complainant" style="display: none">
                              <b>Inside</b><br>
                              <div class="form-group row my-1">
                                  <label for="complainantId" class="col-md-4 col-form-label font-weight-normal">{{ __('Complainant Name') }}</label>
                                  <div class="col-md-6">
                                      <select id="complainantId" name="complainantId" class="form-control" onfocus="this.value=''">
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
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Complainant Full Name*') }}</label>
                                    
                                    <div class="col-md-6">
                                        <input id="cName" type="text" class="form-control" name="cName" placeholder="Enter Complainant Full Name..." onfocus="this.value=''">
                                    </div>
                                </div>
                                
                                <div class="form-group row my-1">
                                    <label for="cAddress" class="col-md-4 col-form-label text-md-right">{{ __('Complainant Address*') }}</label>
                                    
                                    <div class="col-md-6">
                                      <textarea class="form-control" @error('cAddress') is-invalid @enderror placeholder="Enter Complainant's Address here..." name="cAddress" id="cAddress" cols="30" rows="5" onfocus="this.value=''"></textarea>
                                    </div>
                                </div>
                            </div>
                                
                            <hr>
                            <b>Respondents</b><br>
                            <input type="radio" id="insideR" name="fromR" onclick="showRespondent()">
                            <label>Within the barangay</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="outsideR" name="fromR" onclick="showRespondent()">
                            <label>Outside the barangay</label>

                            <div id="respondent" style="display: none">
                              <b>Inside</b><br>
                              <div class="form-group row my-1">
                                  <label for="respondentId" class="col-md-4 col-form-label font-weight-normal">{{ __('Respondent Name') }}</label>
                                  <div class="col-md-6">
                                      <select id="respondentId" name="respondentId" class="form-control" onfocus="this.value=''">
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
                                <label for="respondents" class="col-md-4 col-form-label font-weight-normal">{{ __('Respondent Name') }}</label> 
                                <div class="col-md-6">
                                    <input id="respondents" type="text" class="form-control" @error('respondents') is-invalid @enderror placeholder="Enter Respondent Full Name here..." name="respondents" onfocus="this.value=''">
                                    @error('respondents')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>

                              <div class="form-group row my-1">
                                <label for="respondentsAdd" class="col-md-4 col-form-label font-weight-normal">{{ __("Respondents Address*") }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" @error('respondents') is-invalid @enderror placeholder="Enter Respondent's Address here..." name="respondentsAdd" id="respondentsAdd" cols="30" rows="5" onfocus="this.value=''"></textarea>
                                </div>
                              </div>
                            </div>
                            
                            <hr>
                            <div class="form-group row my-1">
                                <label for="complainDetails" class="col-md-4 col-form-label fw-bold">{{ __('Complaint Details') }}</label>
                                
                                <div class="col-md-6">
                                    <textarea class="form-control" placeholder="Enter details here..." name="compDetails" id="compDetails" cols="30" rows="5" required></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row py-1">
                                <div class="col-md-6 offset-md-4 ">
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
            @if ($errors->any()) 
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
    <script>
        $(document).ready(function () {
           $('select').selectize({
               sortField: 'text'
           });
       });

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
   </script> --}}
   <script>
    $(document).ready(function () {
       $('select').selectize({
           sortField: 'text'
       });
   });

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
</x-layout>

