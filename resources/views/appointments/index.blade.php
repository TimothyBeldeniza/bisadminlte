<x-layout>
    <style>
        .container{
            text-align: center;
            
        }
    </style>
    @section('title', 'Request Document')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        {{-- <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Requested Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Requested Appointments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid --> --}}
    </div>

    <div class="content">
        <div class="container">
            {{-- Appointment --}}
            <img class="" src="{{ asset('images/uc.png') }}" alt="">
        </div>
    </div>
</x-layout>