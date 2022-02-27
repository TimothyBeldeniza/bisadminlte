<!DOCTYPE html>
<html>
<head>
	<title>Document</title>
</head>

<style>
	.header{
    /* border: 3px solid black; */
		font-size: 120%;
		margin: 20px;
      text-transform: uppercase;
	}

	#brgy-logo{
    /* border: 3px solid black; */
		float: left;
	}

  #city-logo{
    /* border: 3px solid black; */
		float: right;
	}

	#qr-code{
    /* border: 3px solid black; */
    margin-bottom: 100px;
	}

	.document-type{
		margin-left: 200px;
    /* width: 50%; */
    /* border: 3px solid black; */
    padding: 10px;
		font-size: 120%;
    text-align: center;
		/* margin: 25px; */
	}
	
	.officers{
		font-size:95%;
		float: left;
		/* border: 1px solid; */
		margin: -105px 20px 0px 5px;
		/* padding: 0px 20px 150px 0px; */
	}

	#type{
		text-transform: uppercase;
	}

	.body{
    /* margin-left: 250px; */
    /* border: 3px solid black; */
		font-size: 100%;
		/* margin-top: 100px; */
	}

	.footer{
    /* margin-left: 250px; */
    /* border: 3px solid black; */
		/* font-size: 130%; */
    margin-top: 50px;
		/* margin: 50px; */
	}
</style>
<body>
	
		<div class="header" align="center">
			{{-- <p><img id="brgy-logo" src="{{ asset('images/'.$brgy->logoPath) }}" alt="brgy-logo" style="height: 100px; width: auto;"></p> --}}
			<p><img id="brgy-logo" src="<?php echo $brgyLogoPath ?>" alt="brgy-logo" style="height: 100px; width: auto;">
      		{{-- <p><img id="city-logo" src="{{ asset('images/'.$brgy->cityLogoPath) }}" alt="city-logo" style="height: 100px; width: auto;"></p> --}}
         <img id="city-logo" src="<?php echo $cityLogoPath ?>" alt="city-logo" style="height: 100px; width: auto;"></p>
			<p>Republika ng Pilipinas <br>
			{{-- Probinsya Ng {{ $brgy->province }} <br> --}}
			Lungsod Ng {{ $brgy->city }}<br>
			<b>Barangay {{ $brgy->name }}</b></p>
		</div>
    <hr>
		<div class="document-type">
			<p><b>Office of the Punong Barangay</b></p>
			<p id="type"><b><u>CERTIFICATE OF {{ $td->docType }}</u></b></p>
		</div>

		<div class="officers">
			<p style="text-transform: uppercase; font-size: 110%"><b>Sangguniang Barangay</b></p>
			<p style="text-transform: uppercase"><b><u>Punong Barangay</u></b></p>
			@foreach ($officials as $chairman)	
				@if($chairman->position == 'Chairman')
					<p>{{ $chairman->name }}</p>
				@endif
			@endforeach
			<p style="text-transform: uppercase"><b><u>Kagawad</u></b><br>
			@foreach ($officials as $councils)
				@if($councils->position == 'Councilor')
					<p>{{ $councils->name }}<br></p>	
				@endif
			@endforeach
			<p style="text-transform: uppercase"><b><u>Punong Kabataan</u></b></p>
			@foreach ($officials as $sk)
				@if($sk->position == 'SK Chairman')
					<p>{{ $sk->name }}<br></p>	
				@endif
			@endforeach
			<p style="text-transform: uppercase"><b><u>Barangay Kalihim</u></b></p>
			@foreach ($officials as $secretary)
				@if($secretary->position == 'Secretary')
					<p>{{ $secretary->name }}<br></p>	
				@endif
			@endforeach
			<p style="text-transform: uppercase"><b><u>Ingat Yaman</u></b></p>
			@foreach ($officials as $treasurer)
				@if($treasurer->position == 'Treasurer')
					<p>{{ $treasurer->name }}<br></p>	
				@endif
			@endforeach
		</div>	

    <div class="body">
      <p>TO WHOM IT MAY CONCERN:</p>
      <p>{!! nl2br(e($template)) !!}</p>
      <p>Issued on this date <b>{{ Carbon\Carbon::now()->format('jS F, Y') }}</b>, from the Barangay Information System, Brgy. {{ $brgy->name }}, {{ $brgy->city }}, {{ $brgy->province }}, Philippines.</p>	
    </div>

    

    <div class="footer">
		@foreach ($officials as $chairman)
			@if($chairman->position == 'Chairman')
				<p align="left">
					<b style="text-transform: uppercase">{{ $chairman->name }}</b> <br>
          PUNONG BARANGAY
				</p>
			@endif
		@endforeach
      <p><img id="qr-code" 
         src="data:image/png;base64,{!! base64_encode(QrCode::format('png')
         ->size(90)
         ->generate($td->unique_code)) !!}"></p>

      <p>Note: Not Valid Without Official Dry Seal <br>
      Paid Under O.R. No: <br>
      Issued By: {{ Auth::user()->firstName. ' ' .Auth::user()->lastName }}</p>
    </div>


</body>
</html>