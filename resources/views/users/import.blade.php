<x-layout>
   <style>
      .required:after {
       content:" *";
       color: red;
      }
   </style>
   @section('title', 'Import Residents')
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Import Residents</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active">Import Residents</li>
                {{-- <li class="breadcrumb-item ">Add Official</li> --}}
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold">Import Excel</div>
        
                        <div class="card-body">       
                            @if (isset($errors) && $errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif

                            <p class="text-card">
                               <b>Create a new Excel File first. No Copy of a file</b> <br>
                               <b>The Excel (xls/xl) file should have the following headers to avoid errors:</b>
                               <ul>
                                  <li>Last Name <b class="text-danger">*</b></li>
                                  <li>First Name <b class="text-danger">*</b></li>
                                  <li>Middle Name</li>
                                  <li>Email <b class="text-danger">*</b></li>
                                  <li>Contact No <b class="text-danger">*</b></li>
                                  <li>Street <b class="text-danger">*</b></li>
                                  <li>DoB <b class="text-danger">*</b></li>
                                  <li>Sex <b class="text-danger">*</b></li>
                                  <li>Civil Status <b class="text-danger">*</b></li>
                                  <li>Citizenship <b class="text-danger">*</b></li>
                               </ul>
                               <b>Note: Each header must require a value, except the Middle Name.</b> <br>
                               <b>Example Excel Content:</b>
                            </p>
                            {{-- <img src="{{ asset('images/sample headers.png') }}" alt="sample_headers image" style="width: 1000px"> --}}
                            <iframe src="{{ asset('images/sample headers.png') }}" style="width: 100%"></iframe>
                            <hr>
                            <form action="/users/import/store" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="file" class="required">Excel File</label>
                                    <input class="form-control" type="file" name="file" required>
                                    <div class="float-right mt-2">
                                       <button type="submit" class="btn btn-primary">Import</button>
                                       <a class="btn btn-secondary" href="{{ route('users.index') }}">Back</a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            @if(session()->has('failures'))
                                <table class="table table-danger">
                                    <tr>
                                        <th>Row</th>
                                        <th>Attribute</th>
                                        <th>Error</th>
                                        <th>Value</th>
                                    </tr>
                                    @foreach (session()->get('failures') as $validation)
                                        <tr>
                                            <td>{{ $validation->row() }}</td>
                                            <td>{{ $validation->attribute() }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($validation->errors() as $e)
                                                        <li>{{ $e }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                {{ $validation->values()[$validation->attribute()]}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

