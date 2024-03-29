<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	{{-- <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/> --}}
	<link rel="icon" type="image/png" href="{{ asset('images/BIS - Logo.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
					@csrf

          <p class="text-center"><img src="{{ asset('images/city-logo.png') }}" width="100px" height="100px"></p><br>

          <span class="login100-form-title p-b-43">
						<b><u>Barangay Information System</u></b>
					</span>
					
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz" >
						
						<input id="email" class="input100 form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Your email">
						<span class="focus-input100"></span>
						{{-- <span class="label-input100">Email</span> --}}
                        
                        
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror



					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input id="myInput"class="input100 form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
						<!-- <input type="checkbox" onclick="myFunction()">Show Password -->
					
						<span class="focus-input100"></span>
						{{-- <span class="label-input100">Password</span> --}}

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
					</div>
					<!-- <div class="txt1">
						<input type="checkbox" onclick="myFunction()">
						<i class="fas fa-eye" type="checkbox" onclick="myFunction()"></i>
					</div> -->



					<div class="flex-sb-m w-full p-t-3 p-b-32">
						{{-- <div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div> --}}

						{{-- <div>
							<a class="txt1" href="{{ route('register') }}">
								{{ __('Register') }}
							</a>
						</div> --}}
						<div>
							<a class="txt1" href="{{ route('password.request') }}">
								{{ __('Forgot Your Password?') }}
							</a> <br>
							{{-- <a class="txt1" href="{{ route('password.request') }}">
								{{ __('Verify Your Password') }}
							</a> --}}
						</div>

						<div>
							{{-- <div></div> --}}
							<a class="txt1">
								<input  type="checkbox" onclick="myFunction()"> Show Password
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							{{ __('Login') }}
						</button>
					</div>
					
					{{-- <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div> --}}

					{{-- <div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div> --}}
				</form>

				<div class="login100-more border" style="background-image: url('images/Drone-Manila-City-Hall.jpg');opacity: 0.5">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>
<script>
	
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
@include('sweetalert::alert')
</body>
</html>