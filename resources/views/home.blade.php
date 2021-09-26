<x-layout>
    <style>
        .scroll {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
    @section('title', 'Home')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Requested Documents</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped projects">
                  <thead>
                      <tr>
                          <th style="width: 15%" class="text-center">
                              Date Requested
                          </th>
                          <th style="width: 15%" class="text-center">
                              Document Type
                          </th>
                          <th style="width: 20%" class="text-center">
                              Purpose
                          </th>
                          <th class="text-center">
                              Status
                          </th>
                          <th style="width: 8%" class="text-center">
                                Action
                          </th>
                          <th style="width: 20%" class="text-center">
                            Reason
                          </th>
                      </tr>
                  </thead>
                  <tbody>

                    @if($documents->count() > 0)                                       
                        @foreach ($documents as $docu)
                            <tr>
                                <td class="text-center">
                                    <a>
                                        {{ $docu->date }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $docu->docType }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $docu->purpose }}
                                    </a>
                                </td>
                                @if ($docu->status == "Unpaid")

                                    <td class="project-state text-center">
                                        <span class="badge badge-danger">{{ $docu->status }}</span>
                                    </td>

                                    
                                    <td class="project-actions text-center">
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel{{ $docu->transId }}">
                                            <i class="fas fa-times-circle"></i>
                                        </i>
                                            Cancel
                                        </a>
                                    </td>
                                    <div class="modal fade" id="cancel{{ $docu->transId }}" tabindex="-1" aria-labelledby="cancelLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelLabel">Cancellation</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="documents/process/{{ $docu->id }}/{{ $docu->transId }}/{{ $docu->userId }}" method="POST">
                                                        <b>Reason for Cancelling</b><br>
                                                        @csrf
                                                        <div class="form-group my-1"> 
                                                            <input type="radio"name="reason" value="Unable to go to Barangay Hall" onclick="cancelOthers{{ $docu->id }}()">
                                                            <label>Not able to go to Barangay Hall</label>
                                                        </div>

                                                        <div class="form-group my-1"> 
                                                            <input type="radio" name="reason" value="Existing Document" onclick="cancelOthers{{ $docu->id }}()">
                                                            <label>Existing Document</label>
                                                        </div>

                                                        <div class="form-group my-1"> 
                                                            <input type="radio" name="reason" value="Changed my mind" onclick="cancelOthers{{ $docu->id }}()">
                                                            <label>Change my mind</label>
                                                        </div>

                                                        <div class="form-group my-1">
                                                            <input type="radio" id="otherC{{ $docu->id }}" name="reason" value="Other" onclick="cancelOthers{{ $docu->id }}()">
                                                            <label>Other</label>
                                                        </div>  

                                                        <div class="form-group my-1" style="display:none;" id="othersC{{ $docu->id }}">
                                                            <label for="otherReason" class="my-1">Specify other reason:</label>
                                                            <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here...">
                                                        </div>
                                                        <div class="float-end my-1">
                                                            <button type="submit" name="submit" value="cancel" onclick="return confirm('Are your sure to cancel request?')" class="btn btn-danger">Cancel Request</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <td class="text-center">
                                        <a>
                                            {{ $docu->reason }}
                                        </a>
                                    </td>

                                @elseif($docu->status == "Disapproved")
                                    <td class="project-state text-center">
                                        <span class="badge badge-danger">{{ $docu->status }}</span>
                                    </td>
                                    
                                    <td class="project-actions text-center"><b>None</b></td>
                                    
                                    <td class="text-center">
                                        <a>
                                            {{ $docu->reason }}
                                        </a>
                                    </td>
                                @else
                                    <td class="project-state text-center">
                                        <span class="badge badge-success">{{ $docu->status }}</span>
                                    </td>
                                    <td class="project-state text-center"><b>None</b></td>

                                    <td class="project-state text-center"><b>Done</b></td>
                                @endif

                            </tr>
                            <script>
                              function cancelOthers{{ $docu->id }}() {
                                  if (document.getElementById('otherC{{ $docu->id }}').checked) {
                                      document.getElementById('othersC{{ $docu->id }}').style.display = 'block';
                                  }
                                  else document.getElementById('othersC{{ $docu->id }}').style.display = 'none';
                              }
                            </script>
                        @endforeach
                    @else
                        <td class="text-center" colspan="6"><b class="text-danger"> No available data</b></td>
                    @endif
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Filed Complaints</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped projects">
                  <thead>
                      <tr>
                          <th class="text-center">
                              Date Filed
                          </th>
                          <th class="text-center">
                              Respondents
                          </th>
                          <th class="text-center">
                              Status
                          </th>
                          <th class="text-center">
                              Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>

                    @if($complaints->count() > 0)                                       
                        @foreach ($complaints as $comp)
                            <tr>

                                <td class="text-center">
                                    <a>
                                        {{ $comp->date }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $comp->respondents }}
                                    </a>
                                </td>

                              @if ($comp->status == "Settled")
                                <td class="project-state text-center">
                                  <span class="badge badge-success">{{ $comp->status }}</span>
                                </td>
                              @elseif ($comp->status == "Escalated")
                                <td class="project-state text-center">
                                  <span class="badge badge-warning">{{ $comp->status }}</span>
                                </td>
                              @else
                                <td class="project-state text-center">
                                  <span class="badge badge-danger">{{ $comp->status }}</span>
                                </td>
                              @endif
                              <td><a class="btn btn-primary my-2" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}">View</a></td>
                            </tr>
                        @endforeach
                    @else
                        <td class="text-center" colspan="4"><b class="text-danger"> No available data</b></td>
                    @endif
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cancelled Document Requests</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped projects">
                  <thead>
                      <tr>
                          <th class="text-center">
                              Date Requested
                          </th>
                          <th class="text-center">
                              Date Canceled
                          </th>
                          <th class="text-center">
                              Document Type
                          </th>
                          <th class="text-center">
                              Purpose
                          </th>
                          <th class="text-center">
                              Status
                          </th>
                          <th class="text-center">
                              Reason
                          </th>
                      </tr>
                  </thead>
                  <tbody>

                    @if($xdocus->count() > 0)                                       
                        @foreach ($xdocus as $xdocu)
                            <tr>

                                <td class="text-center">
                                    <a>
                                        {{ $xdocu->date }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $xdocu->cancelDate }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $xdocu->docType }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $xdocu->purpose }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-danger">{{ $xdocu->status }}</span>
                                </td>

                                <td class="text-center text-danger">
                                    <a>
                                        {{ $xdocu->reason }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td class="text-center" colspan="6"><b class="text-danger"> No available data</b></td>
                    @endif
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

    </section>
    <!-- /.content -->
    
</x-layout>


