<x-layout>
    @section('title', 'Request Information')

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Result</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Request Result</li>
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
                          <div class="card-header bg-danger"><b class="text-light">Request Information</b></div>
                          <div class="card-body">
                              <p class="card-text">
                                  <b class="text-danger">This request do not match any record from us.</b> 
                                  <i class="fas fa-exclamation-circle text-danger"></i>
                              </p> 
                              <hr>
                              <div class="float-right">
                                 <a href="/documents/scanReq" class="btn btn-primary">Scan Another Document</a> &nbsp;&nbsp;&nbsp;
                                 <a href="{{ route('home') }}" class="btn btn-secondary">Back</a> 
                              </div>
                          </div>
                      </div>
                  </div>
                                
              </div>
        </div>
    </div>

</x-layout>