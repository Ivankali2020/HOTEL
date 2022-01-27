@extends('Backend.layout.app')
@section('title') Movie @endsection
@section('room_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-home  icon-gradient bg-mean-fruit">
                    </i>
                </div>

                <div>
                    <a href="{{ route('rooms.index') }}" class="h4 icon-gradient bg-mean-fruit d-flex align-items-center   mb-0 ">
                    Room Details
                    </a>
                </div>
            </div>


        </div>
    </div>

    <div class="container-fluid  mt-3 p-0">
        <div class="row p-0 ">

            <div class="col-xl-6  ">
                <div class="card app-page-title">
                    <div class="card-body  ">
                        <a href="{{ route('rooms.index') }}" class="h4 icon-gradient bg-mean-fruit d-flex align-items-center  justify-content-center  mb-0 ">
                            <span class="pe-7s-home  mr-3 h2  "></span>
                            <span class="lead "> Room Photos  </span>
                        </a>

                        <div class="row align-items-center  ">
                            <div class="col-md-8  ">
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
                    </div>
                </div>
            </div>
            <div class="col-xl-6  ">
                <div class="card  app-page-title">
                    <div class="card-body icon-gradient bg-mean-fruit">
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
                                {{ $room->description }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')


@endsection
