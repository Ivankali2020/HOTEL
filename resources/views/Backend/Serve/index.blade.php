@extends('Backend.layout.app')
@section('title') Serving Booking  @endsection
@section('confirm_booking_server_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Serving List </div>
            </div>

        </div>
    </div>

    <div class="container-fluid  mt-3 p-0">
        <div class="row p-0 ">
            <div class="col-12  ">
                <div class="card app-page-title">
                    <div class="card-body  ">
                        <div class="d-flex justify-content-between align-content-centerc">
                            <a href="{{ route('confirm_booking.serving') }}" class="h4 icon-gradient bg-mean-fruit d-flex align-items-center   mb-0 ">
                                <span class="pe-7s-home  mr-3 h2  "></span>
                                <span class="lead "> Confirmed Lists  </span>
                            </a>
                            <form action="{{ route('confirm_booking.serving') }}" method="get" class="d-flex ">
                                <div class="form-group  mr-4  mb-0 " >
                                    <input type="text" placeholder="search" name="search" class="form-control">
                                </div>
                                <div class="form-group mb-0 ">
                                    <button class="btn btn-outline-primary">
                                        <i class="pe-7s-search h6" ></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <table class="table  table-bordered  p-0  mt-3 table-responsive-md  ">
                            <tr class="table-success font-weight-bolder  ">
                                <td>No</td>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Room</td>
                                <td>Booking Date</td>
                                <td class="text-danger ">CheckOut</td>
                                <td>Price</td>
                            </tr>

                            <tbody>
                            @forelse($servers as $server)
                                <tr>
                                    <td>{{ $server->id }}</td>
                                    <td class="text-nowrap ">{{ $server->name }} </td>
                                    <td class="text-nowrap ">{{ $server->phone }} </td>
                                    <td> {{ $server->getRoom->name }} </td>
                                    <td>
                                        @php
                                            $first_datetime = new DateTime($server->date_from);
                                            $last_datetime = today();
                                            $interval = $first_datetime->diff($last_datetime);
                                        @endphp
                                        <small >
                                            From -> {{  date('j M ',strtotime($server->date_from)) }} To -> Pending ----
                                        </small >
                                        <br>
                                        <span>
                                            {{ $interval->format('%a')  }} Days
                                        </span>

                                    </td>
                                    <td>
                                        <form action="{{ route('confirm_booking.checkIn') }}" method="post" class="form-group text-center " >
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input type="hidden" value="{{ $server->id}}" name="book_id">
                                                <input class="form-check-input"   name="booking_confirm" onchange="this.form.submit()" type="checkbox" role="switch" id="flexSwitchCheckChecked" >
                                            </div>
                                        </form>
                                    </td>
                                    <td class="  ">
                                        {{ $interval->format('%a') == '0' ? $server->getRoom->price   :  $server->getRoom->price * $interval->format('%a') }} $
                                    </td>
                                </tr>
                            @empty
                                <tr class="">
                                    <td>THERE IS NO DATE</td>
                                </tr>
                            @endforelse

                            </tbody>

                        </table>
                        <span >{!! $servers->links() !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
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
                    $('#delConfirmBtn'+id).submit();
                }
            })
        }
    </script>

@endsection

