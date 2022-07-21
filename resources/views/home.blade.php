<x-layout>
    <style>
        .scroll {
            max-height: 300px;
            overflow-y: auto;
        }
        .required:after {
         content:" *";
         color: red;
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
      @role('Chairman|Secretary|Admin')
      <section class="content">
         <div class="container-fluid">
         <h5 class="font-weight-bold">Residents Information</h5>
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
    <!-- /.content-header -->
    @hasanyrole('Admin|Chairman|Councilor|Secretary')
    <div class="content">
        <div class="container-fluid">
            <h5 class="font-weight-bold">Complaints</h5>
          <!-- Small boxes (Stat box) -->
          <div class="row">
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
                 {{-- <a href="{{ route('complaints.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
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
                {{-- <a href="{{ route('complaints.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
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
                {{-- <a href="{{ route('complaints.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
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
                {{-- <a href="{{ route('complaints.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>

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
                 {{-- <a href="{{ route('complaints.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
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
            <h5 class="font-weight-bold">Documents</h5>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
            <!-- ./col -->
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3>{{ $stats['due'] }}</h3>
  
                  <p>For Validation</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-pricetags"></i>
                </div>
                <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col">
              <!-- small box -->
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3>{{ $stats['released'] }}</h3>
  
                  <p>Released</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark-circled"></i>
                </div>
                <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col">
               <!-- small box -->
               <div class="small-box bg-orange">
                 <div class="inner">
                   <h3>{{ $stats['disapproved'] }}</h3>
   
                   <p>Disapproved</p>
                 </div>
                 <div class="icon">
                   <i class="ion ion-alert-circled"></i>
                 </div>
                 <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
             </div>
             <!-- ./col -->
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
                <a href="{{ route('documents.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
        </div><!-- /.container-fluid -->
      </div>
      @endhasrole
    
    @hasanyrole('Chairman|Councilor|Secretary|Treasurer|Clerk|Resident')
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Requested Documents
                 @if($count['dues'] > 0)
                  <span class="badge badge-danger">{{ $count['dues'] }}</span>
                 @endif
              </h3>
             
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-3">
               <div class="table-responsive">
                  <table id="documents_requested" class="table table-striped projects">
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
                              <th style="width: 8%" class="text-center">
                                  Status
                              </th>
                              <th style="width: 8%" class="text-center">
                                  Action
                              </th>
                          </tr>
                      </thead>
                      <tbody>
    
                        @if($documents->count() > 0)                                       
                            @foreach ($documents as $docu)
                                <tr class="text-center">
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
    
                                    <td class="project-state text-center">
                                    @if ($docu->status == "For Validation")    
                                       <span class="badge badge-dark">{{ $docu->status }}</span>
                                    @elseif($docu->status == "Disapproved")
                                       <span class="badge badge-danger">{{ $docu->status }}</span>
                                    @elseif($docu->status == "Cancelled")
                                       <span class="badge badge-danger">{{ $docu->status }}</span>
                                    @else                                
                                       <span class="badge badge-success">{{ $docu->status }}</span>
                                    @endif
                                    </td>

                                    <td class="project-actions text-center">
                                       <div class="d-flex justify-content-center">
                                          @if ($docu->status == "For Validation")
                                          <a class="btn btn-danger btn-sm mr-2" title="Cancel Document" data-toggle="modal" data-target="#cancel{{ $docu->transId }}">
                                             <i class="fas fa-times-circle"></i>
                                          </a>
                                          @endif
                                          <a class="btn btn-primary btn-sm mr-2" title="View Document" data-toggle="modal" data-target="#view{{ $docu->transId }}">
                                             <i class="fas fa-eye"></i>
                                          </a>
                                       </div>
                                     </td>
    
                                </tr>

                                 <div class="modal fade" id="cancel{{ $docu->transId }}" tabindex="-1" aria-labelledby="cancelLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                   <h5 class="modal-title" id="cancelLabel">Cancellation</h5>
                                                </div>
                                                <div class="modal-body">
                                                   <form action="documents/process/{{ $docu->id }}/{{ $docu->transId }}/{{ $docu->userId }}" method="POST">
                                                      <b class="required">Reason for Cancelling</b><br>
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

                                                      <div class="form-group my-1" id="othersC{{ $docu->id }}">
                                                            <label id="otherLabel" for="otherReason" class="my-1">Specify other reason</label>
                                                            <input type="text" class="form-control" id="otherReason" name="otherReason" pattern="[a-zA-Z\s]+" placeholder="Input reason here..." disabled>
                                                      </div>
                                                      <div class="float-right my-1">
                                                            <button type="submit" name="submit" value="cancel" onclick="return confirm('Are your sure to cancel request?')" class="btn btn-danger font-weight-bold">Cancel Request</button>
                                                      </div>
                                                   </form>
                                                </div>
                                          </div>
                                       </div>
                                 </div>

                                 <div class="modal fade" id="view{{ $docu->transId }}" tabindex="-1" aria-labelledby="viewLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                             <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="cancelLabel">View Document Request</h5>
                                             </div>
                                             <div class="modal-body m-3">
                                                <div class="row">
                                                   <div class="col">
                                                      <label>Date Filed: </label><p class="card-text">{{ $docu->date }}</p>    
                                                      <label>Documet Type: </label><p class="card-text">{{ $docu->docType }}</p>    
                                                   </div>
                                                   <div class="col">
                                                      <label>Purpose: </label><p class="card-text">{{ $docu->purpose }}</p>           
                                                      <label>Reason: </label><p class="card-text">{{ $docu->reason == null ? 'None' : $docu->reason }}</p>           
                                                   </div>
                                                </div>
                                             </div>
                                       </div>
                                    </div>
                                 </div>

                                <script>
                                  function cancelOthers{{ $docu->id }}() {
                                      if (document.getElementById('otherC{{ $docu->id }}').checked) {
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
                                </script>
                            @endforeach
                        @endif
                      </tbody>
                  </table>
               </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Filed Complaints 
               @if($count['comps'] > 0)
                  <span class="badge badge-danger">{{ $count['comps'] }}</span>
               @endif
              </h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                 <table id="filed_complaints" class="table table-striped projects">
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
   
                                   <td class="project-state text-center">
                                 @if ($comp->status == "Settled")
                                     <span class="badge badge-success">{{ $comp->status }}</span>
                                 @elseif ($comp->status == "Escalated")
                                     <span class="badge badge-warning">{{ $comp->status }}</span>
                                 @else
                                     <span class="badge badge-danger">{{ $comp->status }}</span>
                                 @endif
                                 </td>
                                 <td class="text-center">
                                    <a class="btn btn-primary my-2" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}"><i class="fas fa-eye"></i></a>
                                 </td>
                               </tr>
                           @endforeach
                       @endif
                     </tbody>
                 </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Complaints Against You (Residential) 
               @if($count['res'] > 0)
                  <span class="badge badge-danger">{{ $count['res'] }}</span>
               @endif
              </h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-3">
               <div class="table-responsive">
                  <table id="complaint_against_resi" class="table table-striped projects">
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
   
                                 <td class="project-state text-center">
                                    @if ($comp->status == "Settled")
                                          <span class="badge badge-success">{{ $comp->status }}</span>
                                    @elseif ($comp->status == "Escalated")
                                          <span class="badge badge-warning">{{ $comp->status }}</span>
                                    @else
                                          <span class="badge badge-danger">{{ $comp->status }}</span>
                                    @endif
                                 </td>
                                 <td class="text-center"><a class="btn btn-primary my-2" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}"><i class="fas fa-eye"></i></a></td>
                              </tr>
                           @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title font-weight-bold">Complaints Against You (Non-Residential)
               @if($count['nonr'] > 0)
                  <span class="badge badge-danger">{{ $count['nonr'] }}</span>
               @endif
              </h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-3">
               <div class="table-responsive">
                  <table id="complaint_against_nonresi" class="table table-striped projects">
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
    
                                 <td class="project-state text-center">
                                    @if ($comp->status == "Settled")
                                        <span class="badge badge-success">{{ $comp->status }}</span>
                                    @elseif ($comp->status == "Escalated")
                                        <span class="badge badge-warning">{{ $comp->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $comp->status }}</span>
                                    @endif
                                 </td>

                                 <td class="text-center"><a class="btn btn-primary my-2" href="{{ route('complaints.showoutsider', $comp->id) }}"><i class="fas fa-eye"></i></a></td>
                                
                              </tr>
                            @endforeach
                        @endif
                      </tbody>
                  </table>
               </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </div>
    </div>
    <!-- /.content -->
    @endhasanyrole
    @section('custom-scripts')
    <script>
      $(document).ready(function () {
         $("#documents_requested").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
         });

         $("#filed_complaints").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "rowReorder": {
               selector: "td:nth-child(2)"
            },
         });
         
         $("#complaint_against_resi").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
         });

         $("#complaint_against_nonresi").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
         });
      });
    </script>
    @endsection
</x-layout>


