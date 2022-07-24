<x-layout>
    <style>
      .required:after {
         content:" *";
         color: red;
      }
    </style>
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
                                             <i class="fas fa-sync-alt"></i>
                                          </button>
                                    </a>        
                               
                            </div>      
                         </form>
                     </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="documents" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Date Requested</th>
                      <th>Date Released</th>
                      <th>Document</th>
                      <th>Purpose</th>
                      <th>Valid ID</th>
                      <th>Status</th>
                      <th>Price</th>
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
                                    @if ($trans->status != "Released")
                                       <td><b>Not yet Released</b></td>
                                    @else
                                       <td>{{ $trans->releaseDate }}</td>
                                    @endif
                                    <td>{{ $trans->docType }}</td>
                                    <td>{{ $trans->purpose }}</td>
                                    <td class="text-center">
                                        @if ($trans->barangayIdPath != null)
                                          <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#bargyId{{$trans->id}}"><i class="fas fa-eye"></i> Show ID</button>
                                          
                                          <div class="modal fade" id="bargyId{{$trans->id}}" tabindex="-1" aria-labelledby="bargyIdLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                  <div class="modal-content">
                                                  <div class="modal-header bg-primary">
                                                      <h5 class="modal-title text-light" id="bargyIdLabel">Valid ID of {{ $trans->firstName. ' ' .$trans->lastName}}</h5>
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
                                          <b>Presented to Staff</b>
                                        @endif
                                        
                                    </td>
         
                                    @if ($trans->status == "Disapproved" || $trans->status == "Cancelled")
                                       <td class="text-danger"><b>{{ $trans->status }}</b></td>
                                       @elseif ($trans->status == "For Validation")
                                          <td class="text-dark"><b>{{ $trans->status }}</b></td>
                                       @else
                                          <td class="text-success"><b>{{ $trans->status }}</b></td>    
                                    @endif
                                    <td>{{ '₱' . $trans->price }}</td>
                                    @hasanyrole('Admin|Clerk|Secretary')
                                    <td class="text-center d-print-none">
                                          @if($trans->status == 'For Validation')
                                          <div class="d-flex justify-content-center">
                                             @can('documents-process')
                                                {{-- <a class="btn btn-primary fw-bold" data-toggle="modal" data-target="#process{{ $trans->id }}">Process</a> --}}
                                                <form action="/documents/process/{{ $trans->id }}/{{ $trans->transId }}/{{ $trans->userId }}" method="POST">
                                                   {{-- <button class="btn btn-primary fw-bold">Process</button> --}}
                                                   @csrf
                                                   <button type="submit" name="submit" value="process" title="Process Request" onclick="return confirm('Are your sure to PROCESS request?')" class="btn btn-sm btn-primary mr-2"><i class="fas fa-thumbs-up"></i></button>
                                                </form>
                                             @endcan
                                             @can('documents-disapprove')
                                                <a class="btn btn-sm btn-danger" data-toggle="modal" title="Disapprove Request" data-target="#disapprove{{ $trans->id }}"><i class="fas fa-thumbs-down"></i></a>
                                             @endcan
                                          </div>
                                          @elseif($trans->status == 'Ready to Claim')
                                             @if($trans->price == 0)
                                                <div class="text-center">
                                                   {{-- <a onclick="enableRelease{{ $trans->id }}()" class="btn btn-sm btn-success" title="Save PDF" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}"><i class="fas fa-save"></i></i></a> --}}
                                                   <a onclick="enableRelease{{ $trans->id }}()" class="btn btn-sm btn-success mb-2" title="Save PDF" target="blank" href="documents/view-document-pdf/{{ $trans->id }}/{{ $trans->userId }}"><i class="fas fa-save"></i></i></a>
                                                   <a id="release{{ $trans->id }}" class="btn btn-sm btn-dark mb-2 disabled font-weight-bold" title="Release Document" onclick="return confirm('Are you sure to proceed?')" href="documents/release/{{ $trans->transId }}"><i class="fas fa-chevron-circle-right"></i></a>
                                                </div>
                                             @else
                                                <a class="btn btn-sm btn-primary font-weight-bold" onclick="return confirm('Are you sure to proceed?')" title="Document Paid" href="documents/paid/{{ $trans->transId }}">Paid</a>
                                             @endif
                                          @elseif($trans->status == 'Paid')
                                             <div class="text-center">
                                                {{-- <a onclick="enableRelease{{ $trans->id }}()" class="btn btn-sm btn-success" title="Save PDF" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}"><i class="fas fa-save"></i></i></a> --}}
                                                <a onclick="enableRelease{{ $trans->id }}()" class="btn btn-sm btn-success mb-2" title="Save PDF" target="blank" href="documents/view-document-pdf/{{ $trans->id }}/ {{ $trans->userId }}"><i class="fas fa-save"></i></i></a>
                                                <a id="release{{ $trans->id }}" class="btn btn-sm btn-dark mb-2 disabled font-weight-bold" title="Release Document" onclick="return confirm('Are you sure to proceed?')" href="documents/release/{{ $trans->transId }}"><i class="fas fa-chevron-circle-right"></i></a>
                                             </div>
                                          @elseif($trans->status == 'Released')
                                             {{-- <a onclick="enableRelease{{ $trans->id }}()" class="btn btn-sm btn-success" title="Save PDF" href="documents/generate-document-pdf/{{ $trans->id }}/{{ $trans->userId }}"><i class="fas fa-save"></i></span></a> --}}
                                             <a onclick="enableRelease{{ $trans->id }}()" class="btn btn-sm btn-success" title="Save PDF" target="blank" href="documents/view-document-pdf/{{ $trans->id }}/{{ $trans->userId }}"><i class="fas fa-save"></i></a>
                                          @endif
                                    </td>
                                    @endhasanyrole
                                    {{-- Disapprove Reason Modal --}}
                                    <div class="modal fade" id="disapprove{{ $trans->id }}" tabindex="-1" aria-labelledby="disapproveLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                   <h5 class="modal-title text-light" id="disapproveLabel">Disapproving</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>                                            
                                                </div>
                                                <div class="modal-body text-start">
                                                   <form action="documents/process/{{ $trans->id }}/{{ $trans->transId }}/{{ $trans->userId }}" method="POST">
                                                      <b class="required">Reason to Disapprove</b><br>
                                                      @csrf

                                                      <div class="form-group my-1"> 
                                                            <input type="radio" id="vId" name="reason" value="Invalid ID" onclick="disapproveOthers{{ $trans->id }}()" required>
                                                            <label>Invalid ID</label>
                                                      </div>

                                                      <div class="form-group my-1"> 
                                                            <input type="radio" id="sp" name="reason" value="Inufficient Purpose" onclick="disapproveOthers{{ $trans->id }}()" required>
                                                            <label>Insufficient Purpose</label>
                                                      </div>

                                                      <div class="form-group my-1">
                                                            <input type="radio" id="otherD{{ $trans->id }}" name="reason" onclick="disapproveOthers{{ $trans->id }}()" required>
                                                            <label>Other</label>
                                                      </div>  

                                                      <div class="form-group my-1" id="othersD{{ $trans->id }}">
                                                            <label id="otherLabel" for="otherReason" class="my-1">Specify other reason</label>
                                                            <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here..." pattern="[a-zA-Z0-9\s]+" disabled>
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
                                             document.getElementById("otherLabel").classList.add('required');
                                             document.getElementById('otherReason').setAttribute("required", "");
                                             document.getElementById('otherReason').removeAttribute("disabled");
                                          }
                                          else 
                                          {
                                             document.getElementById("otherLabel").classList.remove('required');
                                             document.getElementById('otherReason').removeAttribute("required");
                                             document.getElementById('otherReason').setAttribute("disabled", "");
                                          }
                                       }

                                       function enableRelease{{ $trans->id }}()
                                       {
                                          document.getElementById('release{{ $trans->id }}').classList.remove('disabled');
                                       }
                                 </script>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                    @hasanyrole('Chairman|Treasurer')
                    <tfoot>
                       <tr> 
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th class="text-start">
                              For Validation / Ready to Claim: ₱{{ $totalRevenue['due']->totalDue != 0 ? $totalRevenue['due']->totalDue : 0 }}
                          </th>
                          <th></th>
                          <th class="text-start">
                              Paid: ₱{{ $totalRevenue['paid']->totalPaid != 0 ? $totalRevenue['paid']->totalPaid : 0 }}
                          </th>
                          <th class="text-start">
                              Revenue: ₱{{ $revenue = $totalRevenue['paid']->totalPaid + $totalRevenue['due']->totalDue }}
                          </th>
                       </tr>
                    </tfoot>
                    @endhasanyrole
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
      let text = "";
      let from = $('#from').val();
      let to = $('#to').val();
      if (from && to)
      {
         text = from + "-" + to;
      }
      $("#documents").DataTable({
         "responsive": true, 
         "lengthChange": true, 
         "autoWidth": false,
         "buttons": [
            {
               extend:"csv",
               title: 'Document Transactions ' + text,
               exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 7, 8 ]
               },
               footer: true,
            }, {
               extend:"excel",
               title: 'Document Transactions ' + text,
               exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 7, 8 ]
               },
               footer: true,
            }, {
               extend:"pdf",
               title: 'Document Transactions ' + text,
               exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 7, 8 ]
               },
               footer: true,
            }, {
               extend:"print",
               title: 'Document Transactions ' + text,
               exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 7, 8 ]
               },
               footer: true,
            }, 
            "colvis"]
      }).buttons().container().appendTo('#documents_wrapper .col-md-6:eq(0)');
   });
   </script>
   @endsection
</x-layout>




