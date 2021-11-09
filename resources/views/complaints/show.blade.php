<x-layout>
    @section('title', 'Complaint Details')

    <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1 class="m-0">Complaint Details (Residential)</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Residential Complaints</a></li>
                  <li class="breadcrumb-item active">Complaint Details (Residential)</li>
                  </ol>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


    <div class="container">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-sm-6">
              <div class="card">
               <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold"><b>Complaint Details</b></div>
                <div class="card-body">
                    <p class="card-text"><b>Date Filed:</b> {{ Carbon\Carbon::parse($td->date)->format('jS F, Y') }} </p>
                    <p class="card-text"><b>Complainant:</b> {{ $td->firstName . ' ' . $td->lastName }}</p>
                    <p class="card-text"><b>Address:</b> {{ $td->houseNo. ', ' .$td->street}}</p>
                    <p class="card-text"><b>Respondent(s):</b> {{ $td->respondents }}</p>
                    <p class="card-text"><b>Address:</b> {{ $td->respondentsAdd }}</p>
                    <p class="card-text"><b>Hearings/Summons:</b> {{ $hearingCounts }} of 3</p>
                    <p class="card-text"><b>Status:</b>
                    @if ($td->status == "Settled") 
                      <b class="text-success">{{ $td->status }}</b>
                    @elseif ($td->status == "Escalated" || $td->status == "On Going")
                      <b class="text-warning">{{ $td->status }}</b>
                    @elseif ($td->status == "Dismissed")
                      <b class="text-danger">{{ $td->status }}</b>
                    @else
                      <b class="text-dark">{{ $td->status }}</b>
                    @endif
                    </p>
                    <button type="button" class="btn btn-warning fw-bold"  data-toggle="modal" data-target="#compDetails{{$td->id}}">Show Complaint Details</button>
                    <!-- Modal -->
                    <div class="modal fade" id="compDetails{{$td->id}}" tabindex="-1" aria-labelledby="compDetailsLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                            <h5 class="modal-title text-dark" id="compDetailsLabel">Complaint Details</h5>
               
                            </button>
                            </div>
            
                            <div class="modal-body">
                              <b>Complaint Details:</b><br>
                              <p>{{ $td->compDetails }}</p>
                            </div>
            
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End of Modal -->    
                  <hr>
                  @role('Admin|Chairman|Councilor')
                    <a class="btn @if ( $hearingCounts == 3 || $td->status == 'Dismissed' || $td->status == 'Escalated' || $td->status == 'Settled') return disabled @endif btn-success fw-bold float-start" data-toggle="modal" data-target="#record-hearing">Record Hearing</a>
                  @endrole
                  @role('Resident')
                    <a onclick="{{ route('home') }}" class="btn btn-primary fw-bold float-end">Back</a>
                  @endrole
                  @role('Admin|Chairman|Councilor|Secretary')
                    <a href="{{ route('complaints.index') }}" class="btn btn-primary fw-bold float-end">Back</a>
                  @endrole
                </div>
              </div>
              {{-- Modal for Record Hearing --}}
              <div class="modal fade" id="record-hearing" tabindex="-1" aria-labelledby="recordhearingLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-success">
                      <h5 class="modal-title text-light" id="recordhearingLabel">Hearing Details</h5>
                      <button type="button" class="btn-close btn-light" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ url('/complaints/show/hearing/'.$td->id.'/'.$td->transId) }}">
                        @csrf
                        <div class="my-1">
                          <label for="details" class="col-form-label"><b>Input Hearing Details:</b></label>
                          <textarea class="form-control" name="details" id="details" rows="10" placeholder="Input details here..." required></textarea>
                          {{-- <div id="summernote"></div> --}}
                          {{-- <textarea id="details" name="details" required></textarea> --}}
                        </div>
                        <div class="float-end my-2">
                          <button type="submit" class="btn btn-primary">Save Details</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              {{-- End of Modal --}}
            </div>
            <div class="col-sm-6" style="width: 500px">
              <div class="card">
                <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold"><b>Actions</b></div>
                <div class="card-body">
                  <h5 class="card-text">Conditions</h5>
                  @if ($td->reason == Null)
                    <b class="text-danger">No Final Decisions made</b>
                  @else
                    <a class="btn btn-warning fw-bold my-2" data-toggle="modal" data-target="#view-condition">Show Conditions</a>
                    <!-- Conditions View Modal -->
                    <div class="modal fade" id="view-condition" tabindex="-1" aria-labelledby="conditionLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header bg-warning">
                            <h5 class="modal-title text-dark" id="conditionLabel">Conditions Details</h5>
               
                            </button>
                          </div>          
                          <div class="modal-body">
                            <b>Conditions Details:</b><br>
                            <p>{!! nl2br(e($td->reason)) !!}</p>
                            <b>Date Conditions Recorded:</b><br>
                            <p>{{ Carbon\Carbon::parse($td->condition_date)->format('jS F, Y')}}</b>
                          </div>          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                      </div>
                    <!-- End of Hearing View Modal -->
                  @endif
                  <hr>
                  <h5 class="card-text">Measures</h5>
                  @if ($td->status == "Settled")
                    <a class="btn btn-secondary fw-bold my-2" href="{{ url('/complaints/show/view-settle-pdf/'.$td->id.'/'.$td->transId) }}" target="_blank">View Settlement Form</a><br>
                    <a class="btn btn-primary fw-bold my-2" href="{{ url('/complaints/show/generate-settle-pdf/'.$td->id.'/'.$td->transId) }}">Save Settlement Form</a><br>
                  @elseif ($td->status == "Escalated")
                    <a class="btn btn-secondary fw-bold my-2" href="{{ url('/complaints/show/view-escalate-pdf/'.$td->id.'/'.$td->transId) }}" target="_blank">View Escalation Form</a><br>
                    <a class="btn btn-primary fw-bold my-2" href="{{ url('/complaints/show/generate-escalate-pdf/'.$td->id.'/'.$td->transId) }}">Save Escalation Form</a><br>
                  @elseif ($td->status == "Dismissed") 
                    <b class="text-danger">No Measures Required</b>
                  @elseif ($hearingCounts == 3)
                    @role('Admin|Chairman|Councilor')
                      <a class="btn btn-success fw-bold my-2" title="Settle the Complaint" data-toggle="modal" data-target="#record-settle">Settle</a>
                      <a class="btn btn-warning fw-bold my-2" title="Escalate the Complaint" data-toggle="modal" data-target="#record-escalate">Escalate</a>
                      <a class="btn btn-danger fw-bold my-2" title="Dismiss the Complaint" data-toggle="modal" data-target="#record-dismiss">Dismiss</a><br>
                    @endrole 
                    <a class="btn btn-primary fw-bold my-2" href="{{ url('/complaints/show/view-complaint-pdf/'.$td->id.'/'.$td->transId) }}" target="_blank">View Complaint Form</a><br> 
                    <a class="btn btn-secondary fw-bold my-2" href="{{ url('/complaints/show/generate-complaint-pdf/'.$td->id.'/'.$td->transId) }}">Save Complaint Form</a><br> 
                  @elseif($hearingCounts == 0)
                    @role('Admin|Chairman|Councilor')
                      <a class="btn btn-danger fw-bold my-2" title="Dismiss the Complaint" data-toggle="modal" data-target="#record-dismiss">Dismiss</a><br>
                    @endrole 
                    <a class="btn btn-primary fw-bold my-2" href="{{ url('/complaints/show/view-complaint-pdf/'.$td->id.'/'.$td->transId) }}" target="_blank">View Complaint Form</a><br> 
                    <a class="btn btn-secondary fw-bold my-2" href="{{ url('/complaints/show/generate-complaint-pdf/'.$td->id.'/'.$td->transId) }}">Save Complaint Form</a><br> 
                  @else
                  @role('Admin|Chairman|Councilor')
                    <a class="btn btn-success fw-bold my-2" title="Settle the Complaint" data-toggle="modal" data-target="#record-settle">Settle</a>
                    <a class="btn btn-danger fw-bold my-2" title="Dismiss the Complaint" data-toggle="modal" data-target="#record-dismiss">Dismiss</a><br>
                  @endrole 
                    <a class="btn btn-primary fw-bold my-2" href="{{ url('/complaints/show/view-complaint-pdf/'.$td->id.'/'.$td->transId) }}" target="_blank">View Complaint Form</a><br> 
                    <a class="btn btn-secondary fw-bold my-2" href="{{ url('/complaints/show/generate-complaint-pdf/'.$td->id.'/'.$td->transId) }}">Save Complaint Form</a><br>
                  @endif
                  <hr>
                  <h5 class="card-text">Hearing Details</h5>
                  @if($hearingCounts == 0)
                    <b class="text-danger">No Hearings Conducted</b>
                  @endif
                  @for ($ctr = 1; $ctr <= $hearingCounts; $ctr++)
                    <button type="button" class="btn btn-outline-info fw-bold my-2" data-toggle="modal" data-target="#hearing-{{$ctr}}">Hearing No. {{ $ctr }}</button>
                      <!-- Hearing View Modal -->
                      <div class="modal fade" id="hearing-{{$ctr}}" tabindex="-1" aria-labelledby="hearingLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header bg-info">
                            <h5 class="modal-title" id="hearingLabel">Hearing No. {{ $ctr }} Details</h5>
               
                          </div>          
                          <div class="modal-body">
                            <b>Hearing Details:</b><br>
                            {{-- <p>{{ $hearings[$ctr - 1]->details }}</p><br> --}}
                            <p>{!! nl2br(e($hearings[$ctr - 1]->details)) !!}</p>
                            <b>Date Hearing Recorded:</b><br>
                            <p>{{ Carbon\Carbon::parse($hearings[$ctr - 1]->date)->format('jS F, Y')}}</b>
                          </div>          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                      </div>
                    <!-- End of Hearing View Modal -->
                  @endfor
                </div>
              </div>
            </div>              
        </div>
      </div>
    </div>
    {{-- Modal for Record Settlement --}}
    <div class="modal fade" id="record-settle" tabindex="-1" aria-labelledby="recordhearingLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
            <h5 class="modal-title text-light" id="recordhearingLabel">Settlement Details</h5>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ url('/complaints/show/settle/'.$td->id.'/'.$td->transId) }}">
                @method('GET')
                @csrf
                <div class="my-1">
                <label for="details" class="col-form-label"><b>Input Settlement Details:</b></label>
                <textarea class="form-control" name="reason" id="reason" rows="10" placeholder="Input details here..." required></textarea>
                </div>
                <div class="float-end my-3">
                <button type="submit" class="btn btn-primary">Save Settlement Details</button>
                </div>
            </form>
            </div>
        </div>
      </div>
    </div>
    {{-- End of Modal --}}
    {{-- Modal for Record Dismissed --}}
    <div class="modal fade" id="record-dismiss" tabindex="-1" aria-labelledby="recordhearingLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h5 class="modal-title text-light" id="recordhearingLabel">Dismissal Details</h5>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ url('/complaints/show/dismiss/'.$td->id.'/'.$td->transId) }}">
                @method('GET')
                @csrf
                <div class="my-1">
                <label for="details" class="col-form-label"><b>Input Dismissal Details:</b></label>
                <textarea class="form-control" name="reason" id="reason" rows="10" placeholder="Input details here..." required></textarea>
                </div>
                <div class="float-end my-3">
                <button type="submit" class="btn btn-primary">Save Dismissal Details</button>
                </div>
            </form>
            </div>
        </div>
      </div>
  </div>
  {{-- End of Modal --}}
  {{-- Modal for Record Escalate --}}
  <div class="modal fade" id="record-escalate" tabindex="-1" aria-labelledby="recordhearingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header bg-warning">
          <h5 class="modal-title text-dark" id="recordhearingLabel">Escalate Details</h5>
          </button>
          </div>
          <div class="modal-body">
          <form method="POST" action="{{ url('/complaints/show/escalate/'.$td->id.'/'.$td->transId) }}">
              @method('GET')
              @csrf
              <div class="my-1">
              <label for="details" class="col-form-label"><b>Input Escalation Details:</b></label>
              <textarea class="form-control" name="reason" id="reason" rows="10" placeholder="Input details here..." required></textarea>
              </div>
              <div class="float-end my-3">
              <button type="submit" class="btn btn-primary">Save Escalation Details</button>
              </div>
          </form>
          </div>
      </div>
    </div>
  </div>
  {{-- End of Modal --}}
</x-layout>