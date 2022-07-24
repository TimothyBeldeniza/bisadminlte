<x-layout>
    <style>
        .required:after {
          content:" *";
          color: red;
        }
      </style>
    @section('title', 'Add News')

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">News</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="">News</a></li>
                <li class="breadcrumb-item active">Add News</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <div class="content">
        <div class="container">
            <div class="card">
                
                <div style="background-color: #f6f7cd;" class="card-header font-weight-bold">Add News</div>
                <div class="card-body">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <label id="img-label">Images</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    
                                    <input id="images" name="images[]" multiple="multiple" type="file" class="form-control @error('images') is-invalid @enderror" placeholder="Choose File">
    
                                    @error('images')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="required" for="type">Type</label>
    
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                                    </div>
    
                                    <select class="custom-select" name="type" id="type" required>

                                        <option disabled selected>--Choose Type--</option>
                                        <option value="Events">Events</option>
                                        <option value="Announcements">Announcements</option>
    
                                    </select>
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <label class="required">News Title</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
    
                                    <input type="text" class="form-control @error('newsTitle') is-invalid @enderror" name="newsTitle" required placeholder="Title...">
                                    
                                    @error('newsTitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12">
                                <label class="required">Description</label>
                                <div class="input-group mb-3">
    
                                    {{-- <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></i></span>
                                    </div> --}}
                                    
                                    <textarea type="text" name="newsDescription" id="newsDescription" cols="30" rows="10" class="form-control @error('newsDescription') is-invalid @enderror" name="newsDescription" required placeholder="Description..."></textarea>
 
                                    @error('newsDescription')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <input name="author" type="hidden" value="{{ Auth::user()->id }}">
                            <div class="col">
                                <div class="d-flex justify-content-end input-group col-sm mb-3">
                            
                                    <button onclick="return confirm('Are your inputs correct?')" type="submit" class="btn btn-primary font-weight-bold">
                                        {{ __('Submit') }}
                                    </button>
                        
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->    
                
            </div>
        </div>  
    </div>
    <!-- /.card -->

    @section('custom-scripts')
    <script>
        document.getElementById("type").onchange = function(){

            if(document.getElementById("type").value == 'Events'){
                document.getElementById("images").setAttribute('required', 'true');
                document.getElementById("img-label").classList.add('required');

            } else if(document.getElementById("type").value == 'Announcements'){
                document.getElementById("images").removeAttribute('required');
                document.getElementById("img-label").classList.remove('required');
            }

        };

    </script>
    @endsection
</x-layout>