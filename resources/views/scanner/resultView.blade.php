<x-layout>
    @section('title', 'Document Information')

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Scan Result</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Scan Result</a></li>

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success" >
                    <p>{{ $message }}</p>
                  </div>
                 @endif
      
                  <div class="col-sm-6">
                      <div class="card">
                          <div class="card-header 
                              @if ($result)
                                  return bg-success 
                              @else 
                                  return bg-danger
                              @endif">
                                  <b class="text-light">Document Information</b></div>
                          <div class="card-body">
                              @if ($result)
                                  <p class="card-text">
                                      <b class="text-success">This document originally came from us and is authentic.</b>
                                      <i class="fas fa-check-circle text-success"></i>
                                  </p>
                              @else 
                                  <p class="card-text">
                                      <b class="text-danger">This document does not match any record from us.</b> 
                                      <i class="fas fa-exclamation-circle text-danger"></i>
                                  </p> 
                              @endif
                          <hr>
                          <a onclick="history.back()" class="btn btn-primary float-end">Back</a>
                          <a href="/documents/scan" class="btn btn-primary float-end">Scan Another Document</a>
                          </div>
                      </div>
                  </div>
                                
              </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
          @if ($message = Session::get('success'))
            <div class="alert alert-success" >
              <p>{{ $message }}</p>
            </div>
           @endif

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header 
                        @if ($result)
                            return bg-success 
                        @else 
                            return bg-danger
                        @endif">
                            <b class="text-light">Document Information</b></div>
                    <div class="card-body">
                        @if ($result)
                            <p class="card-text">
                                <b class="text-success">This document was originally came from us and is authentic.</b>
                                <i class="fas fa-check-circle text-success"></i>
                            </p>
                        @else 
                            <p class="card-text">
                                <b class="text-danger">This document does not match any record from us.</b> 
                                <i class="fas fa-exclamation-circle text-danger"></i>
                            </p> 
                        @endif
                    <hr>
                    <a onclick="history.back()" class="btn btn-primary float-end">Back</a>
                    </div>
                </div>
            </div>
                          
        </div>
    </div> --}}
</x-layout>