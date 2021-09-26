<x-layout>
    @section('title', 'Documents')
    <div class="row">
        @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <b>{{ $message }}</b>
          </div>
          @endif
        @if ($message = Session::get('danger'))
              <div class="alert alert-danger">
                  <b>{{ $message }}</b>
              </div>
        @endif
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Documents Management</h2>
            </div>
            <div class="float-end" style="padding-right: 50px;">
              <form action="{{ route('documents.index') }}" method="GET" role="search">      
                  <div class="input-group">
                      <span class="input-group-btn mb-3 mt-1">
                          <button class="btn btn-primary mx-3" type="submit" title="Search">
                              <span class="fas fa-search"></span>
                          </button>
                      </span>
      
                      <input type="text" class="form-control mb-3 mr-3" size="40" name="term" placeholder="Search User/Document/Purpose/Status" id="term">
      
                      <a href="{{ route('documents.index') }}" class=" mt-1">
                          <span class="input-group-btn">
                              <button class="btn btn-success ms-3" type="button" title="Refresh Page">
                                  <span class="fas fa-sync-alt"></span>
                              </button>
                          </span>
                      </a>
                  </div>
              </form>
          </div>
        </div>
    </div>
    
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th width="130px">Name</th>
              <th>Date Requested</th>
              <th>Email</th>
              <th>Document</th>
              <th>Purpose</th>
              <th class="text-center" width="130px">Barangay ID</th>
              <th>Status</th>
              <th class="text-center" width="280px">Action</th>
            </tr>
        </thead>
    @if ($data->count() > 0)
        @foreach ($data as $trans)
            @if ($trans->docType != null)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-start"><b>{{ $trans->lastName. ', ' .$trans->firstName}}</b></td>
                    <td>{{ $trans->date}}</td>
                    <td>{{ $trans->email }}</td>
                    <td>{{ $trans->docType }}</td>
                    <td>{{ $trans->purpose }}</td>
                    <td class="text-center">
                        @if ($trans->barangayIdPath != null)
                          <button type="button" class="btn btn-primary fw-bold"  data-bs-toggle="modal" data-bs-target="#bargyId{{$trans->id}}">Show ID</button>
                          
                          <div class="modal fade" id="bargyId{{$trans->id}}" tabindex="-1" aria-labelledby="bargyIdLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                  <div class="modal-header bg-primary">
                                      <h5 class="modal-title text-light" id="bargyIdLabel">Barangay ID of {{ $trans->firstName. ' ' .$trans->lastName}}</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
              
                                  <div class="modal-body" style="display: flex; justify-content:center">
                                      <img style="margin:auto; width: 75%;"src="{{ asset('images/barangayId/'.$trans->barangayIdPath) }}" alt="brgyId" style="height: 300px">
                                  </div>
              
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  </div>
                                  </div>
                              </div>
                          </div>
                        @else
                          <b>No ID Uploaded</b>
                        @endif
                        
                    </td>
                    @if ($trans->status == "Disapproved" || $trans->status == "Cancelled")
                        <td class="text-danger"><b>{{ $trans->status }}</b></td>
                        @elseif ($trans->status == "Unpaid")
                            <td class="text-warning"><b>{{ $trans->status }}</b></td>
                        @else
                            <td class="text-success"><b>{{ $trans->status }}</b></td>    
                    @endif
                    <td class="text-center">
                        @if($trans->status == 'Unpaid')
                            <a class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#process{{ $trans->id }}">Process</a>
                            <a class="btn btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#disapprove{{ $trans->id }}">Disapprove</a>
                        @elseif($trans->status == 'Ready to Claim')
                            <a class="btn btn-primary fw-bold" onclick="return confirm('Are yousure to proceed?')" href="documents/paid/{{ $trans->transId }}">Paid</a>
                            <a class="btn btn-secondary fw-bold" onclick="window.print()" href="documents/view-document-pdf/{{ $trans->id }}/{{ $trans->userId }}" target="_blank">View</a>
                            <a class="btn btn-success fw-bold" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}">Save PDF</a>
                        @elseif($trans->status == 'Paid')
                            <a class="btn btn-secondary fw-bold" href="documents/view-document-pdf/{{ $trans->id }}/{{ $trans->userId }}" target="_blank">View</a>
                            <a class="btn btn-success fw-bold" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}">Save PDF</a>
                        @endif
                        {{-- Process Reason Modal --}}
                        <div class="modal fade" id="process{{ $trans->id }}" tabindex="-1" aria-labelledby="processLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-light" id="processLabel">Processing</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <form action="documents/process/{{ $trans->id }}/{{ $trans->transId }}/{{ $trans->userId }}" method="POST">
                                            <b>Reason to Process</b><br>
                                            @csrf

                                            <div class="form-group my-1"> 
                                                <input type="radio" id="vId" name="reason" value="Valid ID" onclick="processOthers{{ $trans->id }}()">
                                                <label>Valid ID</label>
                                            </div>

                                            <div class="form-group my-1"> 
                                                <input type="radio" id="sp" name="reason" value="Sufficient Purpose" onclick="processOthers{{ $trans->id }}()">
                                                <label>Sufficient Purpose</label>
                                            </div>

                                            <div class="form-group my-1">
                                                <input type="radio" id="otherP{{ $trans->id }}" name="reason" value="Other" onclick="processOthers{{ $trans->id }}()">
                                                <label>Other</label>
                                            </div>  

                                            <div class="form-group my-1" style="display:none;" id="othersP{{ $trans->id }}">
                                                <label for="otherReason" class="my-1">Specify other reason:</label>
                                                <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here...">
                                            </div>
                                            <div class="float-end my-1">
                                                <button type="submit" name="submit" value="process" onclick="return confirm('Are your sure to proceed?')" class="btn btn-primary">Save Reason</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End of Process Reason Modal --}}
                        {{-- Disapprove Reason Modal --}}
                        <div class="modal fade" id="disapprove{{ $trans->id }}" tabindex="-1" aria-labelledby="disapproveLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-light" id="disapproveLabel">Disapproving</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <form action="documents/process/{{ $trans->id }}/{{ $trans->transId }}/{{ $trans->userId }}" method="POST">
                                            <b>Reason to Disapprove</b><br>
                                            @csrf

                                            <div class="form-group my-1"> 
                                                <input type="radio" id="vId" name="reason" value="Invalid ID" onclick="disapproveOthers{{ $trans->id }}()">
                                                <label>Invalid ID</label>
                                            </div>

                                            <div class="form-group my-1"> 
                                                <input type="radio" id="sp" name="reason" value="Inufficient Purpose" onclick="disapproveOthers{{ $trans->id }}()">
                                                <label>Insufficient Purpose</label>
                                            </div>

                                            <div class="form-group my-1">
                                                <input type="radio" id="otherD{{ $trans->id }}" name="reason" value="Other" onclick="disapproveOthers{{ $trans->id }}()">
                                                <label>Other</label>
                                            </div>  

                                            <div class="form-group my-1" style="display:none;" id="othersD{{ $trans->id }}">
                                                <label for="otherReason" class="my-1">Specify other reason:</label>
                                                <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here...">
                                            </div>
                                            <div class="float-end my-1">
                                                <button type="submit" name="submit" value="disapprove" onclick="return confirm('Are your sure to proceed?')" class="btn btn-primary">Save Reason</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End of Disapprove Reason Modal --}}
                    </td>
                </tr>
                <script>
                    function processOthers{{ $trans->id }}() {
                        if (document.getElementById('otherP{{ $trans->id }}').checked) {
                            document.getElementById('othersP{{ $trans->id }}').style.display = 'block';
                        }
                        else document.getElementById('othersP{{ $trans->id }}').style.display = 'none';
                    }
                    
                    function disapproveOthers{{ $trans->id }}() {
                        if (document.getElementById('otherD{{ $trans->id }}').checked) {
                            document.getElementById('othersD{{ $trans->id }}').style.display = 'block';
                        }
                        else document.getElementById('othersD{{ $trans->id }}').style.display = 'none';
                    }
                </script>
            @endif
        @endforeach
    @else
      <tr>
        <td colspan="9" class="text-center"><b class="text-danger">No Data Available</b></td>
      </tr>
    @endif
    </table> 
    <div class="text-center text-primary"><small>By Team Bard</small></div>
    <div class="float-end">{{ $data->links() }}</div>
</x-layout>




