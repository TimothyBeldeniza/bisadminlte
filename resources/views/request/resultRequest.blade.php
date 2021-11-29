<x-layout>
    @section('title', 'Requested Document')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Result</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Request Result</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


  <div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-6" style="width: 400px">
          <div class="card">
            <div style="background-color: #f6f7cd;" class="card-header font-weight-bold"><b>Profile</b></div>
                <div class="card-body">
                  <p class="text-center"><img src="{{ asset('images/users/'.$data->profilePath) }}" style="height: 288px; width: auto;"></p>
                  <p class="text-center text-start card-text"><b>Requisitioner:</b> {{ $data->lastName . ', ' . $data->firstName}}</p>
                  <p class="text-center text-start card-text"><b>Email:</b> {{ $data->email}}</p>
                </div>
          </div>
        </div>
        {{-- <div class="col-sm-6">
          <div class="card">
            <div style="background-color: maroon;" class="card-header text-light"><b>Barangay Identification</b></div>
                <div class="card-body">
                  <p class="text-center"><img src="{{ asset('images/barangayId/'.$data->barangayIdPath) }}" style="height: 192px; width: auto;"></p>

                </div>
          </div>
        </div> --}}

        <div class="col-sm-6" >
            <div class="card">
              <div style="background-color: #f6f7cd;" class="card-header font-weight-bold"><b>Request Details</b></div>
                  <div class="card-body">
                      <p class="card-text"><b>Requested Document:</b> {{ $data->docType }}</p>
                      <p class="card-text"><b>Document Price:</b> {{ '₱' . $data->price }}</p>
                      <p class="card-text"><b>Purpose of Request:</b> {{ $data->purpose }}</p>
                      <p class="card-text"><b>Date Requested:</b> {{ Carbon\Carbon::parse($data->date)->format('jS F, Y') }}</p>
                      @if ($data->status != "Released")
                        <p class="card-text"><b>Not yet Released</b></p>
                      @else
                        <p class="card-text"><b>Date Released:</b> {{ Carbon\Carbon::parse($data->releaseDate)->format('jS F, Y') }}</p>
                      @endif
                      <hr>
                      @if ($data->status == "Disapproved" || $data->status == "Cancelled")
                        <p class="card-text"><b>Status of Request:</b> <b class="text-danger">{{ $data->status }}</b></p>
                      @elseif ($data->status == "Due")
                        <p class="card-text"><b>Status of Request: </b> <b class="text-dark">{{ $data->status }}</b> </p>
                      @else
                        <p class="card-text"><b>Status of Request:</b> <b class="text-success">{{ $data->status }}</b></p>
                      @endif
                      @if ($data->barangayIdPath == null)
                        <p class="card-text"><b>Valid ID: Presented to staff</b></p>
                      @else
                      <p class="card-text"><b>Valid ID: </b>
                      <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#bargyId{{$data->id}}">Show ID</button></p>
                        <div class="modal fade" id="bargyId{{$data->id}}" tabindex="-1" aria-labelledby="bargyIdLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                              <div class="modal-header bg-primary">
                                  <h5 class="modal-title text-light" id="bargyIdLabel">Barangay ID of {{ $data->firstName. ' ' .$data->lastName}}</h5>
                              </div>
          
                              <div class="modal-body" style="display: flex; justify-content:center">
                                  <img style="margin:auto; width: 75%;"src="{{ asset('storage/'.$data->barangayIdPath) }}" alt="brgyId" style="height: 300px">
                              </div>
          
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                              </div>
                          </div>
                        </div>
                      @endif
                      @if ($data->reason == null)
                        <p class="card-text"><b>Reason for Action: No Action taken yet</b></p>
                      @else
                        <p class="card-text"><b>Reason for Action: {{ $data->reason }}</b></p>
                      @endif
                  </div>
            </div>
            <div style="width:50%" class="card">
              <div style="background-color: #f6f7cd;" class="card-header font-weight-bold"><b>Actions</b></div>
              <div class="card-body">
                      @if($data->status == 'For Validation')
                          {{-- <a class="btn btn-primary" data-toggle="modal" data-target="#process{{ $data->id }}">Process</a> --}}
                          {{-- <a class="btn btn-primary fw-bold" href="/documents/process/{{ $data->id }}/{{ $data->transId }}/{{ $data->userId }}">Process</a> --}}
                        <form action="/documents/process/{{ $data->id }}/{{ $data->transId }}/{{ $data->userId }}" method="POST">
                           @csrf
                           <button type="submit" name="submit" value="process" onclick="return confirm('Are your sure to proceed?')" class="btn btn-primary">Process</button>
                        </form>
                        <br>
                        <a class="btn btn-danger" data-toggle="modal" data-target="#disapprove{{ $data->id }}">Disapprove</a>
                      @elseif($data->status == 'Ready to Claim')
                        @if($data->price == 0)
                           <a onclick="enableRelease{{ $data->id }}()" class="btn btn-success fw-bold" onlclick="" href="/documents/generate-document-pdf/{{ $data->id }}/{{ $data->userId }}">Save PDF</a>
                           <a id="release{{ $data->id }}" class="btn btn-dark disabled fw-bold" onclick="return confirm('Are you sure to proceed?')" href="/documents/release/{{ $data->transId }}">Release</a>
                        @else
                           <a class="btn btn-primary fw-bold" onclick="return confirm('Are you sure to proceed?')" href="/documents/paid/{{ $data->transId }}">Paid</a>
                        @endif
                      @elseif($data->status == 'Paid')
                           <a onclick="enableRelease{{ $data->id }}()" class="btn btn-success fw-bold" onlclick="" href="/documents/generate-document-pdf/{{ $data->id }}/{{ $data->userId }}">Save PDF</a>
                           <a id="release{{ $data->id }}" class="btn btn-dark disabled fw-bold" onclick="return confirm('Are you sure to proceed?')" href="/documents/release/{{ $data->transId }}">Release</a>
                      @elseif($data->status == 'Released')
                           <b class="text-success">Document Released</b>
                      @elseif($data->status == 'Disapproved')
                           <b class="text-success">Document Disapproved</b>
                      @else
                          <b class="text-danger">Document Cancelled</b>
                      @endif
                      {{-- Process Reason Modal --}}
                      {{-- <div class="modal fade" id="process{{ $data->id }}" tabindex="-1" aria-labelledby="processLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header bg-primary">
                                      <h5 class="modal-title text-light" id="processLabel">Processing</h5>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/documents/process/{{ $data->id }}/{{ $data->transId }}/{{ $data->userId }}" method="POST">
                                          <b>Reason to Process</b><br>
                                          @csrf

                                          <div class="form-group my-1"> 
                                              <input type="radio" id="vId" name="reason" value="Valid ID" onclick="processOthers{{ $data->id }}()">
                                              <label>Valid ID</label>
                                          </div>

                                          <div class="form-group my-1"> 
                                              <input type="radio" id="sp" name="reason" value="Sufficient Purpose" onclick="processOthers{{ $data->id }}()">
                                              <label>Sufficient Purpose</label>
                                          </div>

                                          <div class="form-group my-1">
                                              <input type="radio" id="otherP{{ $data->id }}" name="reason" value="Other" onclick="processOthers{{ $data->id }}()">
                                              <label>Other</label>
                                          </div>  

                                          <div class="form-group my-1" style="display:none;" id="othersP{{ $data->id }}">
                                              <label for="otherReason" class="my-1">Specify other reason:</label>
                                              <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here...">
                                          </div>
                                          <div class="float-right my-1">
                                              <button type="submit" name="submit" value="process" onclick="return confirm('Are your sure to proceed?')" class="btn btn-primary">Save Reason</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div> --}}
                      {{-- End of Process Reason Modal --}}
                      {{-- Disapprove Reason Modal --}}
                      <div class="modal fade" id="disapprove{{ $data->id }}" tabindex="-1" aria-labelledby="disapproveLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header bg-danger">
                                      <h5 class="modal-title text-light" id="disapproveLabel">Disapproving</h5>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/documents/process/{{ $data->id }}/{{ $data->transId }}/{{ $data->userId }}" method="POST">
                                          <b>Reason to Disapprove</b><br>
                                          @csrf

                                          <div class="form-group my-1"> 
                                              <input type="radio" id="vId" name="reason" value="Invalid ID" onclick="disapproveOthers{{ $data->id }}()">
                                              <label>Invalid ID</label>
                                          </div>

                                          <div class="form-group my-1"> 
                                              <input type="radio" id="sp" name="reason" value="Inufficient Purpose" onclick="disapproveOthers{{ $data->id }}()">
                                              <label>Insufficient Purpose</label>
                                          </div>

                                          <div class="form-group my-1">
                                              <input type="radio" id="otherD{{ $data->id }}" name="reason" value="Other" onclick="disapproveOthers{{ $data->id }}()">
                                              <label>Other</label>
                                          </div>  

                                          <div class="form-group my-1" style="display:none;" id="othersD{{ $data->id }}">
                                              <label for="otherReason" class="my-1">Specify other reason:</label>
                                              <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here...">
                                          </div>
                                          <div class="float-right my-1">
                                              <button type="submit" name="submit" value="disapprove" onclick="return confirm('Are your sure to proceed?')" class="btn btn-primary">Save Reason</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      {{-- End of Disapprove Reason Modal --}}
              </div>
            </div>
          </div>
                        
      </div>
    </div>
  </div>
    <script>
      function processOthers{{ $data->id }}() {
          if (document.getElementById('otherP{{ $data->id }}').checked) {
              document.getElementById('othersP{{ $data->id }}').style.display = 'block';
          }
          else document.getElementById('othersP{{ $data->id }}').style.display = 'none';
      }
      
      function disapproveOthers{{ $data->id }}() {
          if (document.getElementById('otherD{{ $data->id }}').checked) {
              document.getElementById('othersD{{ $data->id }}').style.display = 'block';
          }
          else document.getElementById('othersD{{ $data->id }}').style.display = 'none';
      }
      
      function enableRelease{{ $data->id }}()
      {
         document.getElementById('release{{ $data->id }}').classList.remove('disabled');
      }
    </script>
</x-layout>