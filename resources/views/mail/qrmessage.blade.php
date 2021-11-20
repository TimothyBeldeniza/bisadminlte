
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

<style>
    p{
        font-size: 20px;
        font-family: 'Poppins', sans-serif;


    }

    .text-primary {
        color: darkblue;
    }
</style>
<div>

    <h1>
      Good day, {{ $name }}! 
    </h1>

    <p>
        Your request of {{ $document }} has been successfully submitted. 
        Kindly present the QR code given below to the office for faster transaction process.
        <br>
        <br>
        <b>Reminder to keep in mind:</b><br>
        Do not forget to download your QR code, as it will also serve as your claiming stab. <br>
        Two ways in saving your QR Code: <br>
        <ol> 
            <li><b>If you are using a smartphone:</b></li> 
               <ol> 
                  <li>Press and hold the QR code to view the image.</li> 
                  <li>After viewing the image, tap the three circles in the upper right ang select "Save" to save a copy of your QR code to your smartphone. </li> 
               </ol>
               </li>
            <li><b>If you are using a laptop/desktop:</b></li>
               <ol>
                  <li>Right-click the QR code and select "Save image as..." to save it on your device.</li>
               </ol>
         </ol> 
         <br>

        <b>Note:</b> This is up for double-checking. Would there be any changes, we'll let you know right away. Thank you for understanding. <br><br>
    </p>

    <div>
        <img src="{!!$message->embedData(QrCode::format('png')->size(200)->encoding('UTF-8')->generate($uq), 'QrCode.png', 'image/png')!!}">    
        <br>
    </div>
    <p>
        Thank you, and God bless, 
        <br>
        Barangay {{ $brgyName }}
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

</div>
