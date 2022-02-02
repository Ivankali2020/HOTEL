@extends('Backend.layout.app')
@section('title') Serving Booking  @endsection
@section('confirm_booking_server_active','mm-active')
@section('content')


<div class="container-fluid   mt-3 p-0">
    <div class="row p-0 ">
        <div class="col-md-10  m-auto  ">
            <div class="card app-page-title" style="border-radius: 20px">
                <div class="card-body ">

                    <div class="d-flex justify-content-around align-items-center ">
                        <img src="{{ asset('logo.png') }}"  width="150px"  alt="">
                        <div class="text-center ">
                            <h1 class="fw-bolder icon-gradient bg-mean-fruit "> LARAVEL HOTEL </h1>
                            <div class="mt-5 icon-gradient bg-mean-fruit">
                                4165 Mosia Drive, Broadview, MT, 599105
                                <div class="">
                                    (+95)-9777-12-6169 - info@laravel@hotel.com - www.laravel.com
                                </div>
                            </div>

                        </div>
                    </div>
                    <h3 class="fw-bolder my-5 px-5 icon-gradient bg-mean-fruit">BILL TO</h3>
                    <div class="mx-5 px-5  ">

                        <div class="row mt-4 ">
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">Name</div>
                                <div class="">{{ $book->name }}</div>
                            </div>
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">Receipt No</div>
                                <div class="">{{ uniqid().$book->slug }}</div>
                            </div>
                        </div>

                        <div class="row my-4 ">
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">Phone Number</div>
                                <div class="">{{ $book->phone }}</div>
                            </div>
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">Receipt Date</div>
                                <div class=""> {{ today()->format('d M , Y') }} </div>
                            </div>
                        </div>

                        <div class="row my-4 ">
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">Email</div>
                                <div class=""> {{ $book->email }} </div>
                            </div>
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">CheckIn Date</div>
                                <div class=""> {{  date('M d, Y',strtotime($book->date_from))  }} </div>
                            </div>
                        </div>

                        <div class="row my-4 ">
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">Address</div>
                                <div class="">Myanmar</div>
                            </div>
                            <div class="col-md-4 m-auto  icon-gradient bg-mean-fruit">
                                <div class="fw-bolder">CheckOut Date</div>
                                <div class="">{{ date('M d, Y',strtotime($book->date_from)) }} </div>
                            </div>
                        </div>

                        <table class="table table-bordered mt-5  icon-gradient bg-mean-fruit">
                            <tr class="fw-bolder ">
                                <td>No</td>
                                <td>Room Name</td>
                                <td>Number of Night</td>
                                <td>Price Per Night ($)</td>
                                <td>Total</td>
                            </tr>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $book->getRoom->name }}</td>
                                @php
                                    $first_datetime = new DateTime($book->date_from);
                                    $last_datetime = new DateTime($book->date_to);
                                    $interval = $first_datetime->diff($last_datetime);
                                    $final = $interval->format('%a');
                                @endphp
                                <td>{{ $final }}</td>
                                <td>{{ $book->getRoom->price }}.00</td>
                                <td>{{ $book->getRoom->price * $final }}.00 $</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="fw-bolder  pl-5  text-capitalize ">Discount</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="fw-bolder  pl-5  text-capitalize ">total amout</td>
                                <td>{{$book->getRoom->price * $final}}.00 $</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


