<x-layout>
  @section('title', 'Barangay')
  <style>
    .required:after {
      content:" *";
      color: red;
    }
  </style>
  <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Barangay</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Barangay</li>
                {{-- <li class="breadcrumb-item ">Add Official</li> --}}
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-3">
          <div class="card">
            <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold"><b>Barangay Logo</b></div>
            <div class="card-body">
              <p class="text-center"><img src="{{ url('images/'.$brgy->cityLogoPath) }}" style="height: 150px; width: auto;"></p>
              <p class="text-center font-weight-bold">City Logo</p>
              <p class="text-center"><img src="{{ url('images/'.$brgy->logoPath) }}" style="height: 150px; width: auto;"></p>
              <p class="text-center font-weight-bold">Barangay Logo</p>
              <p class="card-text"><b>Name of Barangay:</b> {{ $brgy->name }}</p>
              <p class="card-text"><b>City:</b> {{ $brgy->city }}</p>
              <p class="card-text"><b>Province:</b> {{ $brgy->province }}</p>
              <p class="card-text"><b>Region:</b> {{ $brgy->region }}</p>
              <p class="card-text"><b>Zip Code:</b> {{ $brgy->zipCode }}</p>
            </div>
          </div>
        </div>
        <div class="col-9">
          <div class="card">
            <div style="background-color: #f6f7cd" class="card-header text-dark font-weight-bold"><b>Edit Barangay Information</b></div>
            <div class="card-body">

                <form method="POST" action="{{ route('barangay.update', $brgy->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label for="Image" class="text-md font-weight-bold">{{ __('City Logo') }}</label>
                    <input type="file" class="form-control @error('cityLogoPath') is-invalid @enderror" name="cityLogoPath">
                    <small style="color: red">Must be a PNG image type!</small>
                    @error('cityLogoPath')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="Image" class="text-md font-weight-bold">{{ __('Barangay Logo') }}</label>
                    <input type="file" class="form-control @error('logoPath') is-invalid @enderror" name="logoPath">
                    <small style="color: red">Must be a PNG image type!</small>
                    @error('logoPath')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="region" class="text-md font-weight-bold required">{{ __('Region') }}</label> 

                    <input id="region" type="text" class="form-control" value="{{ $brgy->region }}" name="region" placeholder="Enter Region..." required>
                  </div>

                  <div class="form-group">
                    <label for="province" class="text-md font-weight-bold required">{{ __('Province') }}</label> 

                    <input id="province" type="text" class="form-control" value="{{ $brgy->province }}" name="province" placeholder="Enter Province..." required>
                  </div>

                  <div class="form-group">
                    <label for="city" class="text-md font-weight-bold required">{{ __('City') }}</label> 
      
                    <input id="city" type="text" class="form-control" value="{{ $brgy->city }}" name="city" placeholder="Enter City..." required>
                  </div>

                  <div class="form-group">
                    <label for="name" class="text-md font-weight-bold required">{{ __('Barangay') }}</label> 
           
                    <input id="name" type="text" class="form-control" value="{{ $brgy->name }}" name="name" placeholder="Enter Barangay Name..." required>
                  </div>

                  <div class="form-group">
                    <label for="zipCode" class="text-md font-weight-bold required">{{ __('Zip Code') }}</label> 
                    <input id="zipCode" type="number" class="form-control" value="{{ $brgy->zipCode }}" name="zipCode" placeholder="Enter Zip Code..." required>
                  </div>

                  <div class="form-group row float-right">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary font-weight-bold" onclick="return confirm('Are your inputs correct?')">{{ __('Submit') }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>

    </div>
  </div>



{{-- Previous Code --}}
  {{-- <div class="container">
    <div class="row justify-content-center">
      <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Edit Barangay</h2>
            </div>
            <div class="float-end">
              <a class="btn btn-dark fw-bold" href="{{ route('home') }}">Back</a>
            </div>
        </div>
      </div>
      <div class="col-sm-6" style="width: 400px">
        <div class="card">
          <div style="background-color: maroon;" class="card-header text-light"><b>Barangay Logo</b></div>
          <div class="card-body">
            <p class="text-center"><img src="{{ url('images/'.$brgy->cityLogoPath) }}" style="height: 150px; width: auto;"></p>
            <p class="text-center fw-bold">City Logo</p>
            <p class="text-center"><img src="{{ url('images/'.$brgy->logoPath) }}" style="height: 150px; width: auto;"></p>
            <p class="text-center fw-bold">Barangay Logo</p>
            <p class="card-text"><b>Name of Barangay:</b> {{ $brgy->name }}</p>
            <p class="card-text"><b>City:</b> {{ $brgy->city }}</p>
            <p class="card-text"><b>Province:</b> {{ $brgy->province }}</p>
            <p class="card-text"><b>Region:</b> {{ $brgy->region }}</p>
            <p class="card-text"><b>Zip Code:</b> {{ $brgy->zipCode }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div style="background-color: maroon;" class="card-header text-light"><b>Edit Barangay Information</b></div>
          <div class="card-body">
              @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                  <b>{{ $message }}</b>
                </div>
              @endif
              <form method="POST" action="{{ route('barangay.update', $brgy->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group my-1">
                  <label for="Image" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('City Logo') }}</label>
                  <input type="file" class="form-control" name="cityLogoPath">
                  <small>Must be a PNG image type!</small>
                </div>

                <div class="form-group my-1">
                  <label for="Image" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Barangay Logo') }}</label>
                  <input type="file" class="form-control" name="logoPath">
                  <small>Must be a PNG image type!</small>
                </div>

                <div class="form-group my-1">
                  <label for="region" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Region*') }}</label> 

                  <input id="region" type="text" class="form-control" value="{{ $brgy->region }}" name="region" placeholder="Enter Region..." required>
                </div>

                <div class="form-group my-1">
                  <label for="province" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Province*') }}</label> 

                  <input id="province" type="text" class="form-control" value="{{ $brgy->province }}" name="province" placeholder="Enter Province..." required>
                </div>

                <div class="form-group my-1">
                  <label for="city" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('City*') }}</label> 

                  <input id="city" type="text" class="form-control" value="{{ $brgy->city }}" name="city" placeholder="Enter City..." required>
                </div>

                <div class="form-group my-1">
                  <label for="name" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Barangay*') }}</label> 

                  <input id="name" type="text" class="form-control" value="{{ $brgy->name }}" name="name" placeholder="Enter Barangay Name..." required>
                </div>

                <div class="form-group my-1">
                  <label for="zipCode" class="col-md-4 col-form-label text-md-right fw-bold">{{ __('Zip Code*') }}</label> 
                  <input id="zipCode" type="number" class="form-control" value="{{ $brgy->zipCode }}" name="zipCode" placeholder="Enter Zip Code..." required>
                </div>

                <div class="form-group row mt-2 float-end">
                  <div class="col-md-6">
                      <button type="submit" class="btn btn-success fw-bold" onclick="return confirm('Are your inputs correct?')">{{ __('Submit') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
  <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
  
  <script type="text/javascript">
    $("#region option:selected").text();
    $("#province option:selected").text();
    $("#city option:selected").text();
    $("#barangay option:selected").text();

    var my_handlers = {

        fill_provinces: function(){

            var region_code = $(this).val();
            $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
            
        },

        fill_cities: function(){

            var province_code = $(this).val();
            $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
        },


        fill_barangays: function(){

            var city_code = $(this).val();
            $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
        }
    };

    $(function(){
        $('#region').on('change', my_handlers.fill_provinces);
        $('#province').on('change', my_handlers.fill_cities);
        $('#city').on('change', my_handlers.fill_barangays);

        $('#region').ph_locations({'location_type': 'regions'});
        $('#province').ph_locations({'location_type': 'provinces'});
        $('#city').ph_locations({'location_type': 'cities'});
        $('#barangay').ph_locations({'location_type': 'barangays'});

        $('#region').ph_locations('fetch_list');
      });
  </script>
</x-layout>