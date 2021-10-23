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
    @hasanyrole('Admin|Chairman|Councilor|Secretary')
    <div class="content">
        <div class="container-fluid">
            <h5>Complaints</h5>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $stats['dismissed'] }}</h3>
  
                  <p>Dismissed</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close-circled"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3>{{ $stats['onGoing'] }}</h3>
  
                  <p>On Going</p>
                </div>
                <div class="icon">
                  <i class="ion ion-load-a"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $stats['escalated'] }}</h3>
  
                  <p>Escalated</p>

                </div>
                <div class="icon">
                  <i class="ion ion-alert-circled"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $stats['settled'] }}</h3>
  
                  <p>Settled</p>
                </div>
                <div class="icon">
                  <i class="ion ion-thumbsup"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{ $stats['unresolved'] }}</h3>
  
                  <p>Unresolved</p>
                </div>
                <div class="icon">
                  <i class="ion ion-thumbsdown"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
          </div>

        </div><!-- /.container-fluid -->
      </div>
   @endhasanyrole

   @hasanyrole('Admin|Chairman|Secretary|Clerk|Treasurer')
      {{-- Documents  --}}
      <div class="content">
        <div class="container-fluid">
            <h5>Documents</h5>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{ $stats['due'] }}</h3>
  
                  <p>Still in Review</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-pricetags"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $stats['readyToClaim'] }}</h3>
  
                  <p>Ready To Claim</p>

                </div>
                <div class="icon">
                  <i class="ion ion-android-hand"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $stats['paid'] }}</h3>
  
                  <p>Paid</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-done-all"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $stats['cancelled'] }}</h3>
  
                  <p>Cancelled</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close-round"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
          </div>

        </div><!-- /.container-fluid -->
      </div>
      @endhasrole
      
      @role('Chairman|Secretary')
      <section class="content">
        <div class="container-fluid">
          <h5 class="mb-2">Residents Information</h5>
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-male"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Male</span>
                  <span class="info-box-number">{{ $stats['male'] }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-pink"><i class="fas fa-female"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Female</span>
                  <span class="info-box-number">{{ $stats['female'] }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-gray"><i class="fas fa-blind"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Senior Citizen</span>
                  <span class="info-box-number">{{ $stats['senior'] }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Total Residents</span>
                  <span class="info-box-number">{{ $stats['totalRes'] }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        </div>
      </section>
    @endrole
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Requested Documents</h3>
             
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
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
                                @if ($docu->status == "Still in Review")

                                    <td class="project-state text-center">
                                        <span class="badge badge-dark">{{ $docu->status }}</span>
                                    </td>

                                    
                                    <td class="project-actions text-center">
                                          <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancel{{ $docu->transId }}">
                                             <i class="fas fa-times-circle"></i>
                                             Cancel
                                          </a>
                                    </td>
                                    <div class="modal fade" id="cancel{{ $docu->transId }}" tabindex="-1" aria-labelledby="cancelLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="cancelLabel">Cancellation</h5>
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
                                                            <label>Changed my mind</label>
                                                        </div>

                                                        <div class="form-group my-1">
                                                            <input type="radio" id="otherC{{ $docu->id }}" name="reason" value="Other" onclick="cancelOthers{{ $docu->id }}()">
                                                            <label>Other</label>
                                                        </div>  

                                                        <div class="form-group my-1" style="display:none;" id="othersC{{ $docu->id }}">
                                                            <label for="otherReason" class="my-1">Specify other reason:</label>
                                                            <input type="text" class="form-control" id="otherReason" name="otherReason" placeholder="Input reason here...">
                                                        </div>
                                                        <div class="float-right my-1">
                                                            <button type="submit" name="submit" value="cancel" onclick="return confirm('Are your sure to cancel request?')" class="btn btn-danger">Cancel Request</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <td class="text-center">
                                        <a>
                                            None
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

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Filed Complaints</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
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
                              <td class="text-center"><a class="btn btn-primary my-2" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}">View</a></td>
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

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Complaints Against You (Residential)</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
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
                              Complainant
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

                    @if($residents->count() > 0)                                       
                        @foreach ($residents as $comp)
                            <tr>

                                <td class="text-center">
                                    <a>
                                        {{ $comp->date }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $comp->firstName. ' ' .$comp->lastName }}
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
                              <td class="text-center"><a class="btn btn-primary my-2" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}">View</a></td>
                            </tr>
                        @endforeach
                    @else
                        <td class="text-center" colspan="4"><b class="text-danger">No available data</b></td>
                    @endif
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Complaints Against You (Non-Residential)</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
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
                              Complainant
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

                    @if($nonresidents->count() > 0)                                       
                        @foreach ($nonresidents as $comp)
                            <tr>

                                <td class="text-center">
                                    <a>
                                        {{ $comp->date }}
                                    </a>
                                </td>

                                <td class="text-center">
                                    <a>
                                        {{ $comp->complainant }}
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
                              <td class="text-center"><a class="btn btn-primary my-2" href="{{ route('complaints.showoutsider', $comp->id) }}">View</a></td>
                            </tr>
                        @endforeach
                    @else
                        <td class="text-center" colspan="4"><b class="text-danger">No available data</b></td>
                    @endif
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Cancelled Document Requests</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
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
      </div>
    </div>
    <!-- /.content -->
</x-layout>


