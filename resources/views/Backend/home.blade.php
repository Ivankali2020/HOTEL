@extends('Backend.layout.app')
@section('title') Dashboard @endsection
@section('admin_home_active','mm-active')
@section('content')
    <div class="app-page-title ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-display2 icon-gradient bg-mean-fruit ">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Dashboard</div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0   page-title-heading mt-3 mt-md-4 ">
        <div class="row ">
            <div class="col-xxl-10  m-auto ">
                <div class="card app-page-title ">
                    <div class="form-group">
                        <form action="{{ route('home') }}" method="get">
                            @csrf
                            <input type="date" onchange="this.form.submit()" value="5/4/2021" name="date" class="form-control ">
                        </form>
                    </div>

                    @if(count($rooms) > 0)
                        <span> {{ $rooms->pluck('created_at') }} </span>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')


@endsection
