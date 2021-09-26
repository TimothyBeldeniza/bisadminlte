<x-layout>
  @section('title', 'Complaints')
  <div class="row">
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
  </div>
  <table class="table table-hover"> 
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
  </table>
  <div class="text-center text-primary"><small>By Team Bard</small></div>
  <div class="float-end">{{ $data->links() }}</div>
</x-layout>



