@extends('Backend.layout.app')
@section('title') Movie @endsection
@section('room_create_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Movie Create </div>
            </div>


        </div>
    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-xl-9  ">
                <div class="card">
                    <div class="card-body">
                        <form class=" mt-2" id="roomsUpdate" action="{{ route('rooms.update',$room->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method("PUT")
                            <div class="row ">
                                <div class="form-group col-6">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6 ">Room Name</label>
                                    <input type="text" name="name" value="{{ old('name',$room->name) }}" class="form-control icon-gradient bg-mean-fruit">
                                    @error('name')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>
                                <div class="form-group col-6 ">
                                    <label class="form-label  icon-gradient bg-mean-fruit h6">Price</label>
                                    <input type="number" name="price" value="{{ old('price',$room->price) }}" class="form-control icon-gradient bg-mean-fruit">
                                    @error('price')
                                    <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group   ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6">Rooms Features</label>
                                <br>
                                <div class="d-flex flex-wrap ">
                                    @foreach(\App\Models\Feature::all() as $feature)
                                        <div class="form-check form-check-inline  ">
                                            <input
                                                class="form-check-input text-lowercase "
                                                type="checkbox"
                                                {{ in_array($feature->id,old('features', $room->features->pluck('id')->toArray() )) ? 'checked' : '' }}
                                                name="features[]" value="{{ $feature->id }}" id="feature{{ $feature->id }}">
                                            <label class="form-check-label  icon-gradient bg-mean-fruit h6  " for="feature{{ $feature->id }}">
                                                {{ $feature->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                @error('features')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                                @error('features.*')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="form-label  icon-gradient bg-mean-fruit h6">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control ">
                                    {{ $room->description }}
                                </textarea>
                                @error('description')
                                <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                                @enderror
                            </div>

                            <div class="form-group mb-0   ">
                               <button form="roomsUpdate" class="btn btn-secondary  mt-2  icon-gradient bg-mean-fruit ">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-3  ">
                <div class="card  ">
                    <div class="card-body text-center p-0 mt-2  ">
                       @forelse($room->photos as $photo)
                            <form id="delPhoto{{$photo->id}}" action="{{ route('photos.destroy',$photo->id) }}" method="post"  enctype="multipart/form-data ">
                                @csrf @method('DELETE')
                                <div class="position-relative">
                                    <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="mb-2 " width="100" alt="">
                                    <button class=" btn btn-white  position-absolute text-danger " style="bottom: 10px;right: 10px" form="delPhoto{{$photo->id}}">
                                        <i class="pe-7s-trash text-danger h3 "></i>
                                    </button>
                                </div>

                            </form>
                        @empty
                                <h1>no data</h1>
                        @endforelse

                        <form action="{{ route('photos.store') }}" id="add" method="post" enctype="multipart/form-data" >
                               @csrf
                               <div class="form-group">
                                   <input type="text" name="room_id" hidden value="{{ $room->id }}">
                                   <input type="file" onchange="this.form.submit()" id="photoAdd" hidden name="photos[]" value="{{ old('photos') }}"  class="form-control" multiple  accept="image/jpeg,image/png">
                               </div>
                            @error('photos')
                            <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>
                            @enderror
                        </form>
                        <div class="">
                            <span class="pe-7s-plus h1" onclick="document.getElementById('photoAdd').click()"></span>
                        </div>

                    </div>
                </div>
            </div>

            {{--            <div class="container-fluid  mt-3 p-0">--}}
            {{--                <div class="row p-0 ">--}}
            {{--                    <div class="col-md-4">--}}
            {{--                        <div class="card">--}}
            {{--                            <div class="card-body">--}}
            {{--                                <form action="{{ route('movie.store') }}" method="post" enctype="multipart/form-data">--}}
            {{--                                    @csrf--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label class="form-label">Movie Name</label>--}}
            {{--                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">--}}
            {{--                                        @error('name')--}}
            {{--                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label class="form-label">Director</label>--}}
            {{--                                        <input type="text" name="director" value="{{ old('director') }}" class="form-control">--}}
            {{--                                        @error('director')--}}
            {{--                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label class="form-label">Release Year</label>--}}
            {{--                                        <input type="text" name="year" value="{{ old('year') }}" class="form-control">--}}
            {{--                                        @error('year')--}}
            {{--                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group ml-3 ">--}}
            {{--                                        <div class="form-check form-switch">--}}
            {{--                                            <input class="form-check-input" {{ old('is_serie') ? 'checked' : '' }} name="is_serie" type="checkbox" role="switch" id="flexSwitchCheckChecked" >--}}
            {{--                                            <label class="form-check-label" for="flexSwitchCheckChecked">Is Series?</label>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label class="form-label">Movie Geners</label>--}}
            {{--                                        <br>--}}
            {{--                                        <div class="row  ">--}}
            {{--                                            @foreach(\App\Models\Genre::all() as $gen)--}}
            {{--                                                <div class="form-check form-check-inline col-5 justify-content-between ml-2 ">--}}
            {{--                                                    <input--}}
            {{--                                                        class="form-check-input text-lowercase "--}}
            {{--                                                        type="checkbox" {{ in_array($gen->id,old('gens',[])) ? 'checked' : '' }}--}}
            {{--                                                        name="gens[]" value="{{ $gen->id }}" id="gen{{ $gen->id }}">--}}
            {{--                                                    <label class="form-check-label" for="gen{{ $gen->id }}">--}}
            {{--                                                        {{ $gen->name }}--}}
            {{--                                                    </label>--}}
            {{--                                                </div>--}}
            {{--                                            @endforeach--}}
            {{--                                        </div>--}}

            {{--                                        @error('gens')--}}
            {{--                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>--}}

            {{--                                        @enderror--}}
            {{--                                        @error('gens.*')--}}
            {{--                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label class="form-label">Photo</label>--}}
            {{--                                        <input type="file" name="photos" class="form-control" accept="image/jpeg,image/png">--}}
            {{--                                        @error('photos')--}}
            {{--                                        <x-alert error="{{ $message }}" css="danger my-4 "> </x-alert>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}

            {{--                                    <input type="submit" class="btn btn-success mt-2 btn-block ">--}}
            {{--                                </form>--}}




            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                    --}}{{--            <div class="col-md-8">--}}
            {{--                    --}}{{--                <div class="card ">--}}
            {{--                    --}}{{--                    <div class="card-body ">--}}
            {{--                    --}}{{--                        <h4 class="icon-gradient bg-mean-fruit d-flex align-items-center  ">--}}
            {{--                    --}}{{--                            <span class="pe-7s-video mr-3 h2  "></span>--}}
            {{--                    --}}{{--                            <span class="lead "> Movie Lists  </span>--}}
            {{--                    --}}{{--                        </h4>--}}
            {{--                    --}}{{--                        <table class="table  table-bordered  p-0  mt-3 table-responsive-md  ">--}}
            {{--                    --}}{{--                            <tr class="table-success font-weight-bolder  ">--}}
            {{--                    --}}{{--                                <td>No</td>--}}
            {{--                    --}}{{--                                <td>Title</td>--}}
            {{--                    --}}{{--                                <td>Director</td>--}}
            {{--                    --}}{{--                                <td> Year</td>--}}
            {{--                    --}}{{--                                <td>Action</td>--}}
            {{--                    --}}{{--                            </tr>--}}

            {{--                    --}}{{--                        <tbody>--}}
            {{--                    --}}{{--                        @foreach($movies as $m)--}}
            {{--                    --}}{{--                            <tr>--}}
            {{--                    --}}{{--                                <td>{{ $m->id }}</td>--}}
            {{--                    --}}{{--                                <td class="text-nowrap ">{{ $m->title }} <span>{{ $m->is_serie ? '(Series)' : '(Movie)' }}</span></td>--}}
            {{--                    --}}{{--                                <td class="text-nowrap ">{{ $m->director }}</td>--}}
            {{--                    --}}{{--                                <td>{{ $m->release_year }}</td>--}}
            {{--                    --}}{{--                                <td class="  ">--}}
            {{--                    --}}{{--                                    <a href="{{ route('movie.edit',$m->id) }}" class="pe-7s-pen text-decoration-none  text-warning  fsize-1 "></a>--}}
            {{--                    --}}{{--                                    <a href="{{ route('movie.show',$m->id) }}" class="pe-7s-info text-decoration-none  mx-2   fsize-1 "></a>--}}
            {{--                    --}}{{--                                    <form id="deleteGenre" action="{{ route('movie.destroy',$m->id) }}" method="post" class=" d-inline     ">--}}
            {{--                    --}}{{--                                        @csrf @method('DELETE')--}}
            {{--                    --}}{{--                                        <div class="pe-7s-trash text-danger   text-decoration-none  fsize-1 " onclick="allow('{{$m->title}}','{{ $m->id }}')"></div>--}}
            {{--                    --}}{{--                                    </form>--}}

            {{--                    --}}{{--                                </td>--}}
            {{--                    --}}{{--                                </td>--}}
            {{--                    --}}{{--                            </tr>--}}

            {{--                    --}}{{--                        @endforeach--}}

            {{--                    --}}{{--                        </tbody>--}}

            {{--                    --}}{{--                        </table>--}}
            {{--                    --}}{{--                        <span >{!! $movies->links() !!}</span>--}}
            {{--                    --}}{{--                    </div>--}}
            {{--                    --}}{{--                </div>--}}
            {{--                    --}}{{--            </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}


            {{--            <div class="col-8">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <h4 class="icon-gradient bg-mean-fruit d-flex align-items-center lead  ">--}}
            {{--                            <span class="pe-7s-video mr-4  "></span>--}}
            {{--                            <span> List Of Movies  </span>--}}
            {{--                        </h4>--}}
            {{--                        <table class="table table-striped table-bordered mt-3 ">--}}
            {{--                            <tr class="table-success font-weight-bolder ">--}}
            {{--                                <td>No</td>--}}
            {{--                                <td>Title</td>--}}
            {{--                                <td>Director</td>--}}
            {{--                                <td>Release Year</td>--}}
            {{--                                <td>Action</td>--}}

            {{--                            </tr>--}}

            {{--                        <tbody>--}}
            {{--                        @foreach($movies as $m)--}}
            {{--                            <tr>--}}
            {{--                                <td>{{ $m->id }}</td>--}}
            {{--                                <td>{{ $m->title }} <span>{{ $m->is_serie ? '(Series)' : '(Movie)' }}</span></td>--}}
            {{--                                <td>{{ $m->director }}</td>--}}
            {{--                                <td>{{ $m->release_year }}</td>--}}
            {{--                                <td class="d-flex ">--}}
            {{--                                    <a href="{{ route('movie.edit',$m->id) }}" class="pe-7s-pen text-decoration-none btn btn-sm  fsize-1 "></a>--}}
            {{--                                    <a href="{{ route('movie.show',$m->id) }}" class="pe-7s-info text-decoration-none btn btn-sm  fsize-1 "></a>--}}
            {{--                                    <form id="deleteGenre" action="{{ route('movie.destroy',$m->id) }}" method="post" class="mx-2  ">--}}
            {{--                                        @csrf @method('DELETE')--}}
            {{--                                    </form>--}}
            {{--                                    <span class="pe-7s-trash text-danger   text-decoration-none btn btn-sm fsize-1 " onclick="allow('{{$m->title}}','{{ $m->id }}')"></span>--}}

            {{--                                </td>--}}
            {{--                                </td>--}}
            {{--                            </tr>--}}

            {{--                        @endforeach--}}

            {{--                        </tbody>--}}

            {{--                        </table>--}}
            {{--                        <span >{!! $movies->links() !!}</span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection

@section('script')
    {{--    <script>--}}
    {{--        function allow(name,id){--}}
    {{--            $.ajaxSetup({--}}
    {{--                headers: {--}}
    {{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--                }--}}
    {{--            });--}}
    {{--            Swal.fire({--}}
    {{--                title: name,--}}
    {{--                text: 'Are you sure?',--}}
    {{--                icon: 'warning',--}}
    {{--                showCancelButton: true,--}}
    {{--                confirmButtonColor: '#3085d6',--}}
    {{--                cancelButtonColor: '#d33',--}}
    {{--                confirmButtonText: 'Yes, delete it!'--}}
    {{--            }).then((result) => {--}}
    {{--                if (result.isConfirmed) {--}}
    {{--                    $('#deleteGenre').submit();--}}
    {{--                }--}}
    {{--            })--}}
    {{--        }--}}
    {{--    </script>--}}

@endsection
