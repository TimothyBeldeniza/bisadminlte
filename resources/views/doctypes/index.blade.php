<x-layout>
  @section('title', 'Document Types')
  <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0">Document Types</h1>
       </div><!-- /.col -->
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
           <li class="breadcrumb-item active">Document Types</li>
         </ol>
       </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
  </div>
  <div class="content">
     <div class="container-fluid">
      <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">List of Document Types</h3>
               <div class="float-right">
                 <span class="input-group-btn">
                     <a class="btn btn-success ms-3 px-3 text-light" href="{{ route('doctypes.create') }}"><i class="fas fa-plus-circle"></i> Add New Document Type</a>
                 </span>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</td>
                      <th>Document Type</td>
                      <th>Price</th>
                      <th>Action</td>
                    </tr>
                  </thead>
                @if($td->count() > 0)
                  @foreach ($td as $docType)
                    <tr>
                      <td>{{ ++$i }}</td>
                      <td>{{ $docType->docType }}</td>
                      <td>₱{{ $docType->price }}</td>
                      <td>
                        <a class="btn btn-primary fw-bold" href="{{ route('doctypes.edit', $docType->id) }}"><i class="fas fa-pen-square"></i> Edit</a>
                        
                        <form action="{{ route('doctypes.destroy', $docType->id) }}" method="post" style="display:inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger fw-bold" onclick="return confirm('Are you sure you want to delete this document?')"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <td colspan="4" class="text-center"><b class="text-danger">No Data Available</b></td>
                @endif
                </table>
             </div>
           </div>
         </div>
      </div>
     </div>
  </div>
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