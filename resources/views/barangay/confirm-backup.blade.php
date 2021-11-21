<x-layout>


@section('title', 'Request Document')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">System Back Up</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">System Back Up</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="container">
        <div class="col-md-9">
            <div class="card">
            <div class="card-header font-weight-bold text-dark" style="background-color: #f6f7cd;">System Back Up</div>
            <div class="card-body">
                <form method="GET" action="/backup" enctype="multipart/form-data">
                    @csrf
                    <p class="font-weight-bold ">Note:
                        The purpose of this module is to backup the whole system with its complete records.
                        
                        Are you sure you want to continue?</p>

                    <div class="form-group float-right my-3">
                        <button type="submit" class="btn btn-primary" >
                        {{ __('Confirm') }}
                        </button>
                    </div>
                </form>     
            </div>
            </div>
        </div>
    </div>
</div>
</x-layout>