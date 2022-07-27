<x-layout>
    @section('title', 'News')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">News Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">News Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                    <span class="input-group-btn">
                        <a class="btn btn-success mb-2 text-light" href="{{ route('news.create') }}"><i class="fas fa-plus-circle"></i> Create News</a>
                    </span>
              <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h3 class="card-title">List of News</h3>
                    </div>
                    <div class="float-right">
                        <div class="row">
                            <a href="{{ route('news.index') }}">
                                <button class="btn btn-success ml-2" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </a>
                        </div>      
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                     <table id="news" class="table table-bordered table-striped">
                       <thead>
                       <tr>
                         <th>News Title</th>
                         <th>Description</th>
                         <th>Type</th>
                         <th>Author</th>
                         <th>Action</th>
                       </tr>
                       </thead>
                       <tbody>
                           @if ($news->count() > 0)
                               @foreach ($news as $key => $new)
                                   <tr>
                                       <td>{{ $new->title  }}</td>
                                       <td>{{ $new->description }}</td>
                                       <td>{{ $new->type }}</td>
                                       @foreach ($users as $user )
                                           @if ($new->userId == $user->id)
                                           <td>{{ $user->firstName . ' ' . $user->lastName }}</td>
                                           @endif
                                       @endforeach
   
                                       <td class="d-flex">
                                           <a href="{{ route('news.edit', $new->id) }}" class="btn btn-link" title="edit"><i class="fas fa-edit fa-lg"></i></a>
   
                                           <form action="#" method="post" style="display:inline">
                                               @csrf
                                               @method('delete')
                                               <button  class="btn btn-link px-0" onclick="return confirm('Are you sure you want to delete this news?')" type="submit"><i class="fas fa-trash-alt text-danger fa-lg" ></i></button>
                                           </form>
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
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      @section('custom-scripts')
      <script>
         $(function () {
            $("#news").DataTable({
               "responsive": true, 
               "lengthChange": true, 
               "autoWidth": false
            });
         });
      </script>
      @endsection
</x-layout>