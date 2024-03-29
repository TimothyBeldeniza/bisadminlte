<x-layout>
    @section('title', 'Users')

    @section('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @endsection

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                @role('Admin')
                    <span class="input-group-btn">
                        <a class="btn btn-success mb-2 text-light" href="{{ route('users.create') }}"><i class="fas fa-plus-circle"></i> Add new user</a>
                    </span>
                    <span class="input-group-btn">
                        <a class="btn btn-success mb-2 text-light" href="users/import"><i class="fas fa-plus-circle"></i> Import Residents</a>
                    </span>
                @endrole
              <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h3 class="card-title">List of Users</h3>
                    </div>
                    <div class="float-right">
                        @role('Admin')
                            <form style="display: inline" action="{{ route('users.index') }}" method="GET" role="search">
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
                                    
                                    <a href="{{ route('users.index') }}">
                                        <button class="btn btn-success ml-2" type="button" title="Refresh page">
                                            <span class="fas fa-sync-alt"></span>
                                        </button>
                                    </a>
                                </div>      
                            </form>
                        @endrole
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="users" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      @role('Admin')
                        <th>Role</th>
                        <th>Action</th>
                      @endrole

                      @hasanyrole('Chairman|Councilor|Secretary|Treasurer|Clerk')
                        <th>Contact No.</th>
                        <th>Address</th>
                      @endhasanyrole
                    </tr>
                    </thead>
                    <tbody>
                        @if ($data->count() > 0)
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->lastName. ', ' .$user->firstName. ' ' .$user->middleName  }}</td>
                                    <td>{{ $user->email }}</td>
                                    @role('Admin')
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    @if ($v == 'Admin')
                                                        <label class="badge bg-success">{{ $v }}</label>
                                                    @elseif ($v == 'Chairman')
                                                        <label class="badge bg-primary">{{ $v }}</label>
                                                    @elseif ($v == 'Councilor')
                                                        <label class="badge bg-danger">{{ $v }}</label>
                                                    @elseif ($v == 'Secretary')
                                                        <label class="badge bg-warning">{{ $v }}</label>
                                                    @elseif ($v == 'Treasurer')
                                                        <label class="badge bg-info">{{ $v }}</label>
                                                    @elseif ($v == 'Clerk')
                                                        <label class="badge bg-dark">{{ $v }}</label>
                                                    @elseif ($v == 'Resident')
                                                        <label class="badge bg-secondary">{{ $v }}</label>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-link px-0" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                            data-attr="{{ route('users.show', $user->id) }}" title="show">
                                            <i class="fas fa-eye fa-lg text-success"></i>
                                            </a>
                                
                                            <a class="btn btn-link" data-toggle="modal" id="largeButton" data-target="#largeModal"
                                            data-attr="{{ route('users.edit', $user->id) }}" title="edit">
                                            <i class="fas fa-edit fa-lg"></i>
                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                <button  class="btn btn-link px-0" onclick="return confirm('Are you sure you want to delete this user?')" type="submit"><i class="fas fa-trash-alt text-danger fa-lg" ></i></button>
                                            </form>
                                        </td>
                                    @endrole

                                    @hasanyrole('Chairman|Councilor|Secretary|Treasurer|Clerk')
                                        <td>+63{{ $user->contactNo }}</td>
                                        <td>{{ $user->houseNo . ' ' . $user->street }}</td>
                                    @endhasanyrole
                                </tr>
                            @endforeach
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

    <!-- Large modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit User</h3>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body" id="largeBody">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Show User</h3>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body" id="mediumBody">
                    
                </div>
            </div>
        </div>
    </div>

    @section('custom-scripts')
    <script>

        $(document).on('click', '#largeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#largeModal').modal("show");
                    $('#largeBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });


        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // Page specific script
         $(function () {
            let text = "";
            let from = $('#from').val();
            let to = $('#to').val();
            if (from && to)
            {
               text = from + "-" + to;
            }
            $("#users").DataTable({
               "responsive": true, 
               "lengthChange": true, 
               "autoWidth": false,
               "buttons": [
                  @hasanyrole('Chairman|Secretary')
                  {
                     extend:"csv",
                     title: 'Registered Users ' + text,
                     exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                     },
                     footer: true,
                  }, {
                     extend:"excel",
                     title: 'Registered Users ' + text,
                     exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                     },
                     footer: true,
                  }, {
                     extend:"pdf",
                     title: 'Registered Users ' + text,
                     exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                     },
                     footer: true,
                  }, {
                     extend:"print",
                     title: 'Registered Users ' + text,
                     exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                     },
                     footer: true,
                  },
                  @endhasanyrole]
            }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
         });
    </script>
    @endsection
</x-layout>

