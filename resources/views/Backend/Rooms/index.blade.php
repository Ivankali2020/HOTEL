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
                <div> Room Lists </div>
            </div>


        </div>
    </div>

    <div class="container-fluid  mt-3 p-0">
        <div class="row p-0 ">

            <div class="col-xl-10 ">
                <div class="card ">
                    <div class="card-body ">
                        <h4 class="icon-gradient bg-mean-fruit d-flex align-items-center  ">
                            <span class="pe-7s-home  mr-3 h2  "></span>
                            <span class="lead "> Room Lists  </span>
                        </h4>
                        <table class="table  table-bordered  p-0  mt-3 table-responsive-md  ">
                            <tr class="table-success font-weight-bolder  ">
                                <td>No</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Features</td>
                                <td>Action</td>
                            </tr>

                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td class="text-nowrap ">{{ $room->name }} </td>
                                    <td class="text-nowrap ">{{ $room->price }} $</td>
                                    <td>
                                        @foreach($room->features as $f)
                                            <span class="badge badge-pill badge-primary ">#{{$f->name}}</span>
                                        @endforeach
                                    </td>
                                    <td class="  ">
                                        <a href="{{ route('rooms.edit',$room->id) }}" class="pe-7s-pen text-decoration-none  text-warning  fsize-1 "></a>
                                        <a href="{{ route('rooms.show',$room->id) }}" class="pe-7s-info text-decoration-none  mx-2   fsize-1 "></a>
                                        <form id="deleteGenre{{ $room->id }}" action="{{ route('rooms.destroy',$room->id) }}" method="post" class=" d-inline     ">
                                            @csrf @method('DELETE')
                                            <div class="pe-7s-trash text-danger   text-decoration-none  fsize-1 " onclick="allow('{{$room->name}}','{{ $room->id }}')"></div>
                                        </form>

                                    </td>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                        <span >{!! $rooms->links() !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function allow(name,id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: name+id,
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteGenre'+id).submit();
                }
            })
        }
    </script>

@endsection
