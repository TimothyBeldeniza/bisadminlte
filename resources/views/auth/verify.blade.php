{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<x-layout>
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Unverified E-mail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Unverified Email</li>
              {{-- <li class="breadcrumb-item ">Add Official</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <div class="section">
      <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-8">
                 <div class="card">
                  <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold">{{ __('Verify Your Email Address') }}</div>
     
                     <div class="card-body">
                         @if (session('resent'))
                             <div class="alert alert-success" role="alert">
                                 {{ __('A new verification link has been sent to your email address.') }}
                             </div>
                         @endif
     
                         {{-- {{ __('Before proceeding, please check your email for a verification link.') }}
                         {{ __('If you did not receive the email') }}, --}}
                         <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                             @csrf
                             <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><b>{{ __('Click here to request a verification link') }}</b></button>.
                         </form>
                         {{ __('To proceed, please check your email for a verification link after clicking the link above') }}
                         {{ __('If you did not receive the email, click the link once more') }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
   </div>
</x-layout>
