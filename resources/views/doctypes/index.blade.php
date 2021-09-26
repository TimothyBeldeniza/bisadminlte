<x-layout>
  @section('title', 'Document Types')
    <div class="row">
        @if ($message = Session::get('success'))
          <div class="alert alert-success">
              <b>{{ $message }}</b>
          </div>
          @endif
        @if ($message = Session::get('danger'))
              <div class="alert alert-danger">
                  <b>{{ $message }}</b>
              </div>
        @endif
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Document Types Management</h2>
            </div>
            <div class="float-end">
              <a class="btn btn-success ms-3 px-3 text-light fw-bold" href="{{ route('doctypes.create') }}"><i class="fas fa-plus-circle"></i> Add Document</a>
            </div>
        </div>
        <table class="table table-hover">
          <thead class="table-dark">
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
    <div class="text-center text-primary"><small>By Team Bard</small></div>
    <div class="float-end">{{ $td->links() }}</div>
</x-layout>