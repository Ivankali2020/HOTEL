@extends('Backend.layout.app')
@section('title') Booking  @endsection
@section('booking_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Booking List </div>
            </div>

        </div>
    </div>

    <div class="container-fluid  mt-3 p-0">
        <div class="row p-0 ">
            <div class="col-xl-10 ">
                <div class="card app-page-title">
                    <div class="card-body  ">
                        <div class="d-flex justify-content-between align-content-centerc">
                            <a href="{{ route('booking.index') }}" class="h4 icon-gradient bg-mean-fruit d-flex align-items-center   mb-0 ">
                                <span class="pe-7s-home  mr-3 h2  "></span>
                                <span class="lead "> Room Lists  </span>
                            </a>
                            <form action="{{ route('booking.index') }}" method="get" class="d-flex ">
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
                                <td>Email</td>
                                <td>Booking Date</td>
                                <td>Action</td>
                            </tr>

                            <tbody>
                            @forelse($bookings as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td class="text-nowrap ">{{ $book->name }} </td>
                                    <td class="text-nowrap ">{{ $book->phone }} </td>
                                    <td>{{ $book->email }} </td>
                                    <td>
                                        @php
                                            $first_datetime = new DateTime($book->date_from);
                                            $last_datetime = new DateTime($book->date_to);
                                            $interval = $first_datetime->diff($last_datetime);
                                            $final = $interval->format('%h');
                                        @endphp
                                        <small >
                                           From -> {{  date('j M ',strtotime($book->date_from)) }} To -> {{  date('j M ',strtotime($book->date_to)) }}
                                        </small >
                                        <br>
                                        <span>
                                            {{ $interval->format('%a')  }} Days
                                        </span>

                                    </td>
                                    <td class="  ">
                                        <form id="delBooking{{ $book->id }}" action="{{ route('booking.destroy',$book->id) }}" method="post" class=" d-inline     ">
                                            @csrf @method('DELETE')
                                            <div class="pe-7s-trash text-danger   text-decoration-none  fsize-1 " onclick="allow('{{$book->name}}','{{ $book->id }}')"></div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="">
                                    <td>THERE IS NO DATE</td>
                                </tr>
                            @endforelse

                            </tbody>

                        </table>
                        <span >{!! $bookings->links() !!}</span>
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
                    $('#delBooking'+id).submit();
                }
            })
        }
    </script>

@endsection

