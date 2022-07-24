<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Escalate</title>
</head>

<style>
    .header{
		font-size: 100%;
		margin: 50px;
	}

	#brgy-logo{
		float: left;
	}

  #city-logo{
		float: right;
	}

	#qr-code{
      margin-right: 30px;
		float:right;
	}

	#name{
		text-transform: uppercase;
	}

    .cr{
		font-size: 100%;
		margin: 25px;
	}

	.body{
		font-size: 100%;
		margin: 25px;
	}

	.footer{
		font-size: 100%;
		margin: 25px;
	}
</style>

<body onload="window.print();" onafterprint="window.close();">

        <div class="header" align="center">
            {{-- <p><img id="brgy-logo" src="{{ asset('images/'.$brgy->logoPath) }}" style="height: 100px; width: auto;"></p> --}}
            <p><img id="brgy-logo" src="<?php echo $brgyLogoPath ?>" alt="brgy-logo" style="height: 100px; width: auto;">
            {{-- <p><img id="city-logo" src="{{ asset('images/'.$brgy->cityLogoPath) }}" alt="city-logo" style="height: 100px; width: auto;"></p> --}}
            <img id="city-logo" src="<?php echo $cityLogoPath ?>" alt="city-logo" style="height: 100px; width: auto;"></p>
            <p>Republika Ng Philippines <br>
            {{-- Probinsya Ng {{ $brgy->province }} <br> --}}
            Lungsod Ng {{ $brgy->city }} <br>
            <b> Barangay {{ $brgy->name }}</b> <br>
            OPISINA NG LUPONG TAGAPAMAYAPA</p>
        </div>
        <hr>

        <div class="cr">
            <p align="center"><b>CERTIFICATION TO FILE CASE</b></p>
            <p><u><b>{{ $td->firstName }} {{ $td->lastName }}</b></u></p>
            <p>{{ $td->houseNo . ' ' . $td->street }}
            <img id="qr-code" 
              src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
              ->size(80)
              ->generate($td->unique_code)) !!}"></p>
            <p>--laban--</p>
            <p><u><b>{{ $td->respondents }}</b></u></p>
            <p>{{ $td->respondentsAdd }}</p>
        </div>

        <div class="body">
            <p>Ito ang patunay na <b>Walang Areglong naganap / Concilliation.</b><br>
            Ang pag-areglo ay pinabulaanan <br>
            At samakatuwid ang kaukulang reklamo para sa hidwaan ay maaari nang ihain sa tanggapan ng Hukuman / Pamahalaan.</p>
        </div>

        <div class="footer">
            <br>
            <p>Sa ngayong araw, <b>{{ Carbon\Carbon::parse($td->up_date)->format('j F, Y') }}</b></p><br>
            <p><b>PATUNAY:</b></p> <br>
            @foreach ($officials as $chairman)
                @if($chairman->position == 'Chairman')
                    <p><u style="text-transform: uppercase">{{ $chairman->name }}</u> <br>
                    <b>Punong Barangay</b></p>
                @endif
            @endforeach
            <br>
            <p>Note: Not Valid Without Official Dry Seal <br>
            Issued By: {{ Auth::user()->firstName. ' ' .Auth::user()->lastName }}</p>
        </div>

</body>
</html>