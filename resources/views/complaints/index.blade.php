<x-layout>
  @section('title', 'Complaints')

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Residential Complaints</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Residential Complaints</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List of Residential Complaints</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped"> 
              <thead >
                  <tr>
                  <th>No.</th>
                  <th>Date Filed</th>
                  <th>Complainant</th>
                  <th>Respondent</th>
                  <th>Status</th>
                  <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @if ($data->count() > 0)
                    @foreach ($data as $comp)
                      <tr>
                          <td>{{ ++$i }}</td>
                          <td>{{ $comp->date }}</td>
                          <td>{{ $comp->firstName. ' ' .$comp->lastName }}</td>
                          <td>{{ $comp->respondents }}</td>
                          @if ($comp->status == "Settled") 
                            <td class="text-success"><b>{{ $comp->status }}</b></td>
                          @elseif ($comp->status == "Escalated" || $comp->status == "On Going")
                            <td class="text-warning"><b>{{ $comp->status }}</b></td>
                          @elseif ($comp->status == "Dismissed")
                            <td class="text-danger"><b>{{ $comp->status }}</b></td>
                          @else
                            <td class="text-dark"><b>{{ $comp->status }}</b></td>
                          @endif
                          <td>
                              <a class="btn btn-primary fw-bold" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}">View</a> 
                          </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="6" class="text-center"><b class="text-danger">No Data Available</b></td>
                    </tr> 
                  @endif
              </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</div>

  {{-- <div class="row">
    @if ($message = Session::get('success'))
    <div class="alert alert-success" >
      <b>{{ $message }}</b>
    </div>
    @endif
    @if ($message = Session::get('danger'))
      <div class="alert alert-danger" >
        <b>{{ $message }}</b>
      </div> 
    @endif
      <div class="col-lg-12 margin-tb">
          <div class="float-start">
              <h2>Residential Complaint Management</h2>
          </div>
          <div class="float-end" style="padding-right: 50px;">
            <form action="{{ route('complaints.index') }}" method="GET" role="search">
              <div class="input-group">
                  <span class="input-group-btn mb-3 mt-1">
                      <button class="btn btn-primary me-3" type="submit" title="Search">
                          <span class="fas fa-search"></span>
                      </button>
                  </span>
        
                  <input type="text" class="form-control mb-3 mr-3" size="40" name="term" placeholder="Search Complainant/Respondent/Status" id="term">
        
                  <a href="{{ route('complaints.index') }}" class=" mt-1">
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
  </div> --}}
  {{-- <table class="table table-hover"> 
      <thead class="table-dark">
          <tr>
          <th>No.</th>
          <th>Date Filed</th>
          <th>Complainant</th>
          <th>Respondent</th>
          <th>Status</th>
          <th>Action</th>
          </tr>
      </thead>
    @if ($data->count() > 0)
      @foreach ($data as $comp)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $comp->date }}</td>
            <td>{{ $comp->firstName. ' ' .$comp->lastName }}</td>
            <td>{{ $comp->respondents }}</td>
            @if ($comp->status == "Settled") 
              <td class="text-success"><b>{{ $comp->status }}</b></td>
            @elseif ($comp->status == "Escalated" || $comp->status == "On Going")
              <td class="text-warning"><b>{{ $comp->status }}</b></td>
            @elseif ($comp->status == "Dismissed")
              <td class="text-danger"><b>{{ $comp->status }}</b></td>
            @else
              <td class="text-dark"><b>{{ $comp->status }}</b></td>
            @endif
            <td>
                <a class="btn btn-primary fw-bold" href="complaints/show/{{ $comp->id }}/{{ $comp->userId }}">View</a> 
            </td>
        </tr>
      @endforeach
    @else
      <tr>
        <td colspan="6" class="text-center"><b class="text-danger">No Data Available</b></td>
      </tr> 
    @endif
  </table> --}}


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



