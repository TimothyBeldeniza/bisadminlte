<x-layout>
    @section('title', 'Documents')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Document Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Document Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h3 class="card-title">List of Requested Documents</h3>
                    </div>
                    <div class="float-right">
                        <form style="display: inline" action="{{ route('documents.index') }}" method="GET" role="search">
                            <div class="row">
                                <label for="date" class="col-form-label">From</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control input-sm" id="from" name="from" required>
                                </div>
                                <label for="date" class="col-form-label">To</label>
                                <div class="col-sm-4">
                                <input type="date" class="form-control input-sm" id="to" name="to" required>
                                </div>        
                                <button type="submit" name="search" title="Search" class="btn btn-success">Range</button>
                                <a href="{{ route('documents.index') }}">
                                    <button class="btn btn-success ml-2" type="button" title="Refresh page">
                                        <span class="fas fa-sync-alt"></span>
                                    </button>
                                </a>
                               
                            </div>      
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Date Requested</th>
                      <th>Email</th>
                      <th>Document</th>
                      <th>Price</th>
                      <th>Purpose</th>
                      <th>Barangay ID</th>
                      <th>Status</th>
                      @hasanyrole('Admin|Clerk|Secretary')
                      <th>Action</th>
                      @endhasanyrole
                    </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $trans)
                                @if ($trans->docType != null)

                                 <tr>
                                    <td>{{ ++$i }}</td>
                                    <td class="text-start"><b>{{ $trans->lastName. ', ' .$trans->firstName}}</b></td>
                                    <td>{{ $trans->date}}</td>
                                    <td>{{ $trans->email }}</td>
                                    <td>{{ $trans->docType }}</td>
                                    <td>{{ '₱' . $trans->price }}</td>
                                    <td>{{ $trans->purpose }}</td>
                                    <td class="text-center">
                                        @if ($trans->barangayIdPath != null)
                                          <button type="button" class="btn btn-primary fw-bold"  data-toggle="modal" data-target="#bargyId{{$trans->id}}">Show ID</button>
                                          
                                          <div class="modal fade" id="bargyId{{$trans->id}}" tabindex="-1" aria-labelledby="bargyIdLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                  <div class="modal-content">
                                                  <div class="modal-header bg-primary">
                                                      <h5 class="modal-title text-light" id="bargyIdLabel">Barangay ID of {{ $trans->firstName. ' ' .$trans->lastName}}</h5>
                                                      {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                                                  </div>
                              
                                                  <div class="modal-body" style="display: flex; justify-content:center">
                                                      <img style="margin:auto; width: 75%;"src="{{  asset('storage/'.$trans->barangayIdPath) }}" alt="brgyId" style="height: 300px">
                                                  </div>
                              
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                                  </div>
                                              </div>
                                          </div>
                                        @else
                                          <b>Walk In Request</b>
                                        @endif
                                        
                                    </td>
         
                                    @if ($trans->status == "Disapproved" || $trans->status == "Cancelled")
                                       <td class="text-danger"><b>{{ $trans->status }}</b></td>
                                       @elseif ($trans->status == "Due")
                                          <td class="text-dark"><b>{{ $trans->status }}</b></td>
                                       @else
                                          <td class="text-success"><b>{{ $trans->status }}</b></td>    
                                    @endif
                                    @hasanyrole('Admin|Clerk|Secretary')
                                    <td class="text-center">
                                          @if($trans->status == 'Due')
                                             @can('documents-process')
                                                <a class="btn btn-primary fw-bold" data-toggle="modal" data-target="#process{{ $trans->id }}">Process</a>
                                             @endcan
                                             @can('documents-disapprove')
                                                <a class="btn btn-danger fw-bold" data-toggle="modal" data-target="#disapprove{{ $trans->id }}">Disapprove</a>
                                             @endcan
                                          @elseif($trans->status == 'Ready to Claim')
                                             <a class="btn btn-primary fw-bold" onclick="return confirm('Are yousure to proceed?')" href="documents/paid/{{ $trans->transId }}">Paid</a>
                                             <a class="btn btn-success fw-bold" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}">Save PDF</a>
                                          @elseif($trans->status == 'Paid')
                                             {{-- <a class="btn btn-secondary fw-bold" href="documents/view-document-pdf/{{ $trans->id }}/{{ $trans->userId }}" target="_blank">View</a> --}}
                                             <a class="btn btn-success fw-bold" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}">Save PDF</a>
                                          @endif
                                    </td>
                                    @endhasanyrole
                                    {{-- Process Reason Modal --}}
                                    <div class="modal fade" id="process{{ $trans->id }}" tabindex="-1" aria-labelledby="processLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                   <h5 class="modal-title text-light" id="processLabel">Processing</h5>
                                                   {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> --}}
                                                </div>
                                                <div class="modal-body text-left">
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
                                                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                            <td colspan="10" class="text-center"><b class="text-danger">No Data Available</b></td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      @section('custom-scripts')

      <script>
            $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
      </script>
      @endsection
</x-layout>




