
<x-layout>
 
    <style>
        .float-right:hover
        {
            color:maroon;
        }
    </style>

    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    @section('title', 'Officials')


    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Officials</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Officials</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <div class="content">
        <div class="container">
            <div class="flex-box-container-1">
                @if (Auth::user()->hasRole('Admin'))
                    <div style="padding-bottom: 10px">
                        <a class="@if (!Auth::user()->can('barangay-official-create') || $off === 11)
                            return btn disabled
                        @endif" href="{{ route('officials.create') }}">Add a new official &rarr;</a>
                    </div>
                @endif
                
                {{-- <div style="border: 2px solid black"> --}}
                @foreach ($officials as $official)
                <div style="display: flex; justify-content:space-between">

                    <div>
                        <div class="float-left" style="margin-right: 50px">
                            <img style="height: 200px !important; width: 200px !important;"src="{{ asset('images/officials/' . $official->imagePath) }}" alt="">
                        </div>

                        <div class="float-right">
                            <h4>
                                {{ $official->firstName . ' ' . $official->middleName . ' ' . $official->lastName }}
                            </h4>
                            <span >
                                {{ $official->position }}
                            </span>
                        </div>  
                        
                    </div>


                    
                        
                        @if (Auth::user()->hasRole('Admin'))
                            <div class="float-right"> 
                                <a class="@if (!Auth::user()->can('barangay-official-edit'))
                                    return btn disabled
                                @endif" style="margin-left: 13px" href="{{ route('officials.edit',$official->id) }}">
                                Edit &rarr;
                                </a>
    
                                <form action="{{ route('officials.destroy', $official->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure you want to delete this Official?')" style="color:red" class="btn btn-link @if (!Auth::user()->can('barangay-official-delete'))
                                        return disabled
                                    @endif" type="submit"> Delete &rarr;</button>
                                </form>
                            </div> 
                        @endif

                        

                    </div>
                    <div>
                        <hr class="mt-4 mb-8">
                    </div>
                @endforeach
                {{-- </div> --}}
                    
            </div>
        </div>
      </div>
</x-layout>
    
