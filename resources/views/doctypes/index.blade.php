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
                     <a class="btn btn-primary font-weight-bold" href="{{ route('doctypes.edit', $docType->id) }}"><i class="fas fa-pen-square"></i> Edit</a>
                     
                     <form action="{{ route('doctypes.destroy', $docType->id) }}" method="post" style="display:inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger font-weight-bold" onclick="return confirm('Are you sure you want to delete this document?')"><i class="fas fa-trash-alt"></i> Delete</button>
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
         {{-- Deleted Document Types --}}
         <div class="card">
            <div class="card-header">
            <h3 class="card-title">List of Deleted Document Types</h3>
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
               @if($tddel->count() > 0)
                  @foreach ($tddel as $docType)
                     <tr>
                        <td>{{ ++$j }}</td>
                        <td>{{ $docType->docType }}</td>
                        <td>₱{{ $docType->price }}</td>
                        <td>
                        {{-- <a class="btn btn-success font-weight-bold" href="#"><i class="fas fa-pen-square"></i> Restore</a> --}}
                        
                        <form action="doctypes/restore/{{ $docType->id }}" method="post" style="display:inline">
                           @csrf
                           @method('get')
                           <button type="submit" class="btn btn-success font-weight-bold" onclick="return confirm('Are you sure you want to restore this document?')"><i class="fas fa-pen-square"></i> Restore</button>
                        </form>
                        </td>
                     </tr>
                  @endforeach
               @endif
               </table>
            </div>
         </div>
     </div>
  </div>
  @section('custom-scripts')
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": true, 
        "autoWidth": false,
      });
    });
  </script>
@endsection
</x-layout>