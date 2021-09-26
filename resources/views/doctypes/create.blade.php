<x-layout>
  @section('title', 'Create Document Types')
  <!-- include libraries(jQuery, bootstrap) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
  <div class="container">
    <div class="row justify-content-certer">
      <div class="">
        <div class="row">
          @if ($message = Session::get('success'))
            <div class="alert alert-success" >
              <b>{{ $message }}</b>
            </div>
          @endif
          <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Create Document Type</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-dark fw-bold" href="{{ route('doctypes.index') }}">Back</a>
            </div>
        </div>
        </div>
        <div class="card">
          <div class="card-header text-light fw-bold" style="background-color: maroon;">{{ __('Document Type Form') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('doctypes.store') }}">
              {{-- @method('POST') --}}
              @csrf
              <div class="form-group my-1">
                <label for="Image" class=" fw-bold">{{ __('Document Title*') }}</label>
                <input type="text" class="form-control" name="docType" placeholder="Enter Document title here...">
              </div>
              <div class="form-group my-1">
                <label for="Image" class=" fw-bold">{{ __('Document Content*') }}</label>
                  {{-- <textarea class="form-control" name="template" id="summernote"></textarea> --}}
                  <textarea class="form-control" rows="10" name="template" placeholder="Enter Document Content here..."></textarea>
              </div>
              <div class="form-group my-1">
                <label for="Image" class=" fw-bold">{{ __('Document Price*') }}</label>
                  <input type="number" class="form-control" step="1" min="0" max="100" name="price" placeholder="ex. 50">
              </div>
              <div class="form-group my-1">
                <button type=”submit” class="btn btn-success fw-bold float-end" style="background-color: #198754">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if ($errors->any()) 
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
  </div>
  
  <!-- summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script type="text/javascript">
    $('#summernote').summernote({
        placeholder: 'Enter Document Content here...',
        height: 300
    });
  </script>
  
  </x-layout> 