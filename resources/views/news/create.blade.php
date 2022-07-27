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
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">
                                <label class="required">News Title</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
    
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required placeholder="Title...">
                                    
                                    @error('title')
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
    
                            <div class="col-12">
                                <label class="required">Description</label>
                                <div class="input-group mb-3">
                                    
                                    <textarea type="text" name="description" id="description" 
                                    cols="30" rows="10" 
                                    class="form-control 
                                    @error('description') is-invalid @enderror" 
                                    placeholder="Description..." required></textarea>
 
                                    @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 d-none" id="img-input">
                              <label class="required" id="img-label">Images</label>
                                  <div class="input-images mb-2"></div>
                            </div>

                            <div class="col">
                                <div class="d-flex justify-content-end input-group mb-3">
                            
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
               //  document.getElementsByName("images").setAttribute('required', 'true');
               //  document.getElementById("img-label").classList.add('required');
                document.getElementById("img-input").classList.remove('d-none');
                
               } else {
                  //  document.getElementsByName("images").removeAttribute('required');
                  //  document.getElementById("img-label").classList.remove('required');
                  document.getElementById("img-input").classList.add('d-none');
            }
        };

        $('.input-images').imageUploader();

    </script>
    @endsection
</x-layout>