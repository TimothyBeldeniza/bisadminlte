{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settle</title>
</head>

<style>
    .header{
		font-size: 100%;
		margin: 50px;
    text-transform: uppercase;
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

  #types{
    margin-right: 50px;
  }

  .cr{
		font-size: 100%;
		margin: 0px 25px;
	}

	.body{
		font-size: 100%;
		margin-left: 25px;
	}

	.footer{
		font-size: 100%;
		margin: 25px;
	}
</style>

<body>

        <div class="header" align="center">
            {{-- <p><img id="brgy-logo" src="{{ asset('images/'.$brgy->logoPath) }}" style="height: 100px; width: auto;"></p>
            <p><img id="city-logo" src="{{ asset('images/'.$brgy->cityLogoPath) }}" alt="city-logo" style="height: 100px; width: auto;"></p> --}}
            <p><img id="brgy-logo" src="<?php echo $brgyLogoPath ?>" alt="brgy-logo" style="height: 100px; width: auto;"></p>
            <p><img id="city-logo" src="<?php echo $cityLogoPath ?>" alt="city-logo" style="height: 100px; width: auto;"></p>
            <p>Republika Ng Philippines <br>
            {{-- Probinsya Ng {{ $brgy->province }} <br> --}}
            Lungsod Ng {{ $brgy->city }} <br>
            <b> Barangay {{ $brgy->name }}</b> <br>
            OPISINA NG LUPONG TAGAPAMAYAPA</p>
        </div>

        <hr>

        <div class="cr">
            <p><u><b>{{ $td->firstName }} {{ $td->lastName }}</b></u><br>{{ $td->houseNo . ' ' . $td->street }}
              <img id="qr-code" 
              src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
              ->size(80)
              ->generate($td->unique_code)) !!}"></p>
            <p>--laban--</p>
            <p><u><b>{{ $td->respondents }}</b></u><br>{{ $td->respondentsAdd }}</p>
            <p align="center"><b>AMICABLE SETTLEMENT / AREGLO</b></p>
        </div>


        <div class="body">
            <p>Kami, ang nagreklamo at tumutugon sa kaso na nasa itaas, ay sumasang-ayon na ayusin ang aming hidwaan sa pamamagitan ng mga sumusunod:<br>
                <b>{{ $td->compDetails }}</b><br><br>
                <b>Sa mga kondisyong:</b><br>
                {!! nl2br(e($td->reason)) !!}<br><br>
                at parehong nangangako na sumunod nang matapat kasama ang mga tuntunin sa pag-areglo sa itaas.
            </p>
        </div>

        <div class="footer">
            <p>Ginawa sa araw ng <b>{{ Carbon\Carbon::parse($td->date)->format('j F, Y') }}</b></p>
            <p><u style="text-transform: uppercase">{{ $td->firstName }} {{ $td->lastName }}</u><br><b>Nagrereklamo</b></p>
            <p><u style="text-transform: uppercase">{{ $td->respondents }}</u><br><b>Tumutugon</b></p>
            <p>Natanggap at Nagsampa ngayong <b>{{ Carbon\Carbon::now()->format('j F, Y') }}</b></p>
            <p><b>PAGPAPATUNAY</b></p>
            <p>Pinagtitibay ko rito na ang mga sumusunod na pag-areglo ay malayang inilunsad sa magkabilang partido matapos kong maipaliwanag sa kanilang dalawa ang kalikasan at bunga ng naturang pag-areglo.</p>
            @foreach ($officials as $chairman)
                @if($chairman->position == 'Chairman')
                    <p style="text-transform: uppercase; margin-top: 40px;"><b>{{ $chairman->name }}</b><br>
                    PUNONG BARANGAY</p>
                @endif
		        @endforeach
        </div>

</body>
</html>