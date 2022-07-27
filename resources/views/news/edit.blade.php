<x-layout>
   <style>
       .required:after {
         content:" *";
         color: red;
       }
     </style>
   @section('title', 'Edit News')

   <div class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
             <h1 class="m-0">News</h1>
           </div><!-- /.col -->
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
               <li class="breadcrumb-item active">Edit News</li>
             </ol>
           </div><!-- /.col -->
         </div><!-- /.row -->
       </div><!-- /.container-fluid -->
   </div>
   
   <div class="content">
       <div class="container">
           <div class="card">
               
               <div style="background-color: #f6f7cd;" class="card-header font-weight-bold">Edit News</div>
               <div class="card-body">
                   <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                       @csrf
                       @method('PUT')
                       <div class="row">

                           <div class="col-lg-6">
                               <label class="required">News Title</label>
                               <div class="input-group mb-3">
                                   <div class="input-group-prepend">
                                       <span class="input-group-text"><i class="fas fa-user"></i></span>
                                   </div>
   
                                   <input type="text" value="{{ $news->title }}" class="form-control @error('title') is-invalid @enderror" name="title" required placeholder="Title...">
                                   
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

                                 <input type="text" id="type" value="{{ $news->type }}" class="form-control" name="type" readonly>
 
                                 {{-- <select class="form-control-plaintext" name="type" id="type" readonly>

                                     <option disabled selected>--Choose Type--</option>
                                     <option value="Events">Events</option>
                                     <option value="Announcements">Announcements</option>
 
                                 </select> --}}
                             </div>
                           </div>
   
                           <div class="col-12">
                               <label class="required">Description</label>
                               <div class="input-group mb-3">
                                   
                                   <textarea type="text" name="description" id="description" 
                                   cols="30" rows="5" 
                                   class="form-control @error('description') is-invalid @enderror" 
                                   placeholder="Description..." required>{{ $news->description }}</textarea>

                                   @error('description')
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                   @enderror
                               </div>
                           </div>

                           <div class="col-lg-6 d-none" id="img-input">
                              <label class="required" id="img-label">Reupload Images</label>
                                  <div class="input-images mb-2"></div>
                           </div>

                           <div class="col-lg-6 d-none mb-2" id="img-preview">
                              <label>Preview Images</label>
                              <div id="preview-imgs" class="carousel slide" data-ride="carousel">
                                 <div class="carousel-inner">
                                    @foreach ($photos as $photo)
                                     <div class="carousel-item @if ($loop->first) active @endif">
                                       <img class="d-block w-100" src="{{  asset('storage/'.$photo->path) }}">
                                     </div>
                                    @endforeach
                                 </div>
                                 <a class="carousel-control-prev" href="#preview-imgs" role="button" data-slide="prev">
                                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   <span class="sr-only">Previous</span>
                                 </a>
                                 <a class="carousel-control-next" href="#preview-imgs" role="button" data-slide="next">
                                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   <span class="sr-only">Next</span>
                                 </a>
                               </div>
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
      // document.getElementById("type").value = '{{ $news->type }}';

      if(document.getElementById("type").value == 'Events'){
         document.getElementById("img-preview").classList.remove('d-none');
         document.getElementById("img-input").classList.remove('d-none');

      } else {
         document.getElementById("img-preview").classList.add('d-none');
         document.getElementById("img-input").classList.add('d-none');
      }

      let x = 0;
      let preloaded = [];
      @foreach ($photos as $photo)   
         preloaded.push({id: x++, src: "{{  asset('storage/'.$photo->path) }}"})
      @endforeach

      $('.input-images').imageUploader();

   </script>
   @endsection
</x-layout>