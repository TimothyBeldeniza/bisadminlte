<x-layout>
    @section('title', 'Request Information')
    <div class="container">
        <div class="row justify-content-center">
          @if ($message = Session::get('success'))
            <div class="alert alert-success" >
              <p>{{ $message }}</p>
            </div>
           @endif

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header" style="background-color: maroon"><b class="text-light">Request Information</b></div>
                    <div class="card-body">
                        <p class="card-text">
                            <b class="text-danger">This request do not match any record from us.</b> 
                            <i class="fas fa-exclamation-circle text-danger"></i>
                        </p> 
                        <hr>
                        <a onclick="history.back()" class="btn btn-primary float-end">Back</a>
                    </div>
                </div>
            </div>
                          
        </div>
    </div>
</x-layout>