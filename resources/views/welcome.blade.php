@extends('layouts.app')
@section('content')

<div class="container  mt-3 p-0">
    <div class="row p-0 ">
        @foreach($rooms as $room)
        <div class="col-xl-4 mb-3 ">
            <div class="card app-page-title"  style="height:750px;">
                <div class="card-body d-flex flex-column justify-content-between  ">
                    <a href="{{ route('rooms.index') }}" class="h4 icon-gradient bg-mean-fruit d-flex align-items-center  justify-content-center  mb-0 ">
                        <span class="pe-7s-home  mr-3 h2  "></span>
                        <span class="lead "> Room Photos  </span>
                    </a>
                    <div class="row align-items-center  ">
                        <div class="col-md-8 ">
                            <img src="{{ asset('storage/thumbnail/'.$room->feature_photo) }}" class="my-3 rounded-3  " width="100%" alt="">
                        </div>
                        <div class="col-4">
                            @forelse($room->photos as $key=>$photo)
                                @if($key < 3)

                                    <img src="{{ asset('storage/photo/'.$photo->name) }}" class="my-3 rounded-3"  width="100%" alt="">
                                @endif
                            @empty
                                There is no image in this room!
                            @endforelse
                        </div>
                    </div>
                    <div class=" ">
                        <h4 class="text-center"> Room Facilites </h4>
                        <table class="table table-borderless mt-3 text-capitalize   ">
                            <tbody>
                            <tr>
                                <td class=" ">Name</td>
                                <td class=" ">{{ $room->name  }} </td>
                            </tr>
                            <tr>
                                <td class=" ">Price</td>
                                <td class=" ">{{ $room->price }} $</td>
                            </tr>
                            </tbody>
                        </table>
                        <h5 class="ml-2"> Room Features </h5>
                        <ul>
                            @foreach($room->features as $f)
                                <li class="">#{{$f->name}}</li>
                            @endforeach
                        </ul>

                        <div class="mt-3 ml-2 ">
                            <h5> Descripiton </h5>
                            <p style="text-align: justify ">
                               {{ \Illuminate\Support\Str::words($room->description,20) }}
                            </p>
                        </div>

                    </div>

                    <!-- Button trigger modal -->
                    <div class="align-self-end justify-self-end ">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $room->id }}">
                            Booking
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{ $room->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('booking.store') }}" method="post" id="bookingForm">
                                        @csrf
                                        @if($errors->any())
                                            <div class="alert alert-danger">
                                                <p><strong>Opps Something went wrong</strong></p>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row ">
                                            <div class="form-group col-md-6 ">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name"  class="form-control" >
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="row my-4 ">
                                            <div class="form-group col-md-6 ">
                                                <label for="checkin">Checkin</label>
                                                <input type="date" name="date_from" id="checkin" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="checkout">Checkout</label>
                                                <input type="date" name="date_to" id="checkout" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="form-group col-md-6 ">
                                                <label for="phone">Phone</label>
                                                <input type="number" name="phone" id="phone" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <input type="number" hidden name="room_id" value="{{ $room->id }}" id="room" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="mt-4 float-end ">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Booking</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript" src="{{ asset('Backend/assets/scripts/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

            function allow(name,id){
                Swal.fire({
                    title: name,
                    text: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteGenre').submit();
                    }
                })
            }
        </script>


{{--sweet alert 2--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{{--{!! JsValidator::formRequest('App\Http\Requests\StoreBookingRequest', '#bookingForm'); !!}--}}

@yield('script')

{{--this is for session alert with toast--}}
{{--@include('Backend.layout.flash')--}}
{{--@include('components.alert')--}}
@include('components.message')
    </body>
</html>
