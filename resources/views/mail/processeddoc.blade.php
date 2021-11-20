<h1>
    Hello, {{ $name }}!
</h1>

<p>
    Your requested document has been processed and is ready.
    Kindly claim it to our office. 
    <br>
    <br>
    Thank you!
    <br>
    <br>
    <b>Note:</b> Present the QR code for the faster transaction as it will also serve as your claiming stab for the requested document.
    <br>
    <div>
        <img src="{!!$message->embedData(QrCode::format('png')->size(200)->encoding('UTF-8')->generate($uq), 'QrCode.png', 'image/png')!!}">    
        <br>
    </div>
    <p>
        Thank you, and God bless, 
        <br>
        Barangay {{ $brgy }}
        <br>
    </p>
    
    {{-- <p class="text-primary">
        Blk. 52 Lot 27 Ph 2. <br>
        Upper Bicutan, Taguig City <br>
        Metro Manila 1633 <br>
        Tel. No. 838-3910/839-2296 <br>
    </p> --}}
    
    {{-- <img id="brgy-logo" src="{{ url('https://bis.test/images/brgy-logo.png') }}" alt="brgy-logo" style="height: 100px; width: auto;"> --}}
    <br>
    <b>***DO NOT REPLY TO THIS EMAIL***</b>

</p>