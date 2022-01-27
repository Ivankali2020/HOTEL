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
                <div class="card app-page-title">
                    <div class="card-body  ">
                      <div class="d-flex justify-content-between align-content-centerc">
                          <a href="{{ route('rooms.index') }}" class="h4 icon-gradient bg-mean-fruit d-flex align-items-center   mb-0 ">
                              <span class="pe-7s-home  mr-3 h2  "></span>
                              <span class="lead "> Room Lists  </span>
                          </a>
                          <form action="{{ route('rooms.index') }}" method="get" class="d-flex ">
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
                                <td>Price</td>
                                <td>Features</td>
                                <td>Action</td>
                            </tr>

                            <tbody>
                            @forelse($rooms as $room)
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
                            @empty
                                <tr class="">
                                    <td>THERE IS NO DATE</td>
                                </tr>
                            @endforelse

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
