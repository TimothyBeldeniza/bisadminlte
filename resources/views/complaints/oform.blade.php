<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complaint</title>
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

<body>

        <div class="header" align="center">
            {{-- <p><img id="brgy-logo" src="{{ asset('images/'.$brgy->logoPath) }}" style="height: 100px; width: auto;"></p> --}}
            <p><img id="brgy-logo" src="<?php echo $brgyLogoPath ?>" alt="brgy-logo" style="height: 100px; width: auto;">
            {{-- <p><img id="city-logo" src="{{ asset('images/'.$brgy->cityLogoPath) }}" alt="city-logo" style="height: 100px; width: auto;"></p> --}}
            <img id="brgy-logo" src="<?php echo $brgyLogoPath ?>" alt="brgy-logo" style="height: 100px; width: auto;"></p>
            <p>Republika Ng Philippines <br>
            {{-- Probinsya Ng {{ $brgy->province }} <br> --}}
            Lungsod Ng {{ $brgy->city }} <br>
            <b> Barangay {{ $brgy->name }}</b> <br>
            OPISINA NG LUPONG TAGAPAMAYAPA</p>
        </div>
        <hr>

        <div class="cr">
            <p><u><b>{{ $td->complainant }}</b></u></p>
            <p>{{ $td->address }}
            <img id="qr-code" 
              src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
              ->size(80)
              ->generate($td->unique_code)) !!}"></p>
            <p>--laban--</p>
            <p><u><b>{{ $td->respondents }}</b></u></p>
            <p>{{ $td->respondentsAdd }}</p>
            <p align="center"><b>C O M P L A I N T / R E K L A M O</b></p>
        </div>

        <div class="body">
            <p>Ako ngayon ay nagreklamo laban sa nabanggit na tumugon dahil sa paglabag sa aking mga karapatang at interes sa mga sumusunod na pamamaraan:<br><br>
              {!! nl2br(e($td->compDetails)) !!}
            </p>
        </div>

        <div class="footer">
            <br>
            <p>Ginawa ngayong araw, <b>{{ Carbon\Carbon::now()->format('j F, Y') }}</b> </p> <br>
            <p id="name"><u>{{ $td->complainant }}</u></p>
            <p>Lagda ng Nagrereklamo</p> <br>
            <p>Natanggap at Nagsampa ngayong <b>{{ Carbon\Carbon::now()->format('j F, Y') }}</b></p> <br>
            @foreach ($officials as $official)
                @if($official->position == 'Chairman')
                    <p><u style="text-transform: uppercase">{{ $official->name }}</u><br>
                    <b>Punong Barangay</b></p>
                @endif
            @endforeach
            {{-- <p><img id="qr-code" 
              src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
              ->size(100)
              ->generate($td->unique_code)) !!}"></p> --}}
        </div>

</body>
</html>