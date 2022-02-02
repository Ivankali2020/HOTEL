@extends('layouts.app')
@section('title') Booking @endsection
@section('content')

    <div class="container mt-5 ">
        <div class="row">
            <div class="">
                <div class="app-page-title bg-mean-green  ">
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
            </div>
        </div>
    </div>

    <div class="container p-0   page-title-heading mt-3 mt-md-4 ">
        <div class="row ">
            <div class="col-xl-8  m-auto ">
                <div class="card app-page-title ">
                    <div class="card-body text-center " >
                        {!!  '<img   src="data:image/png;base64,' . DNS2D::getBarcodePNG('4', 'QRCODE') . '" alt="barcode"   />'; !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-body text-center   d-flex justify-content-center align-items-center " style="width: 200px;height: 200px">
            <?php echo DNS2D::getBarcodeSVG('4445645656', 'QRCODE',5,5); ?>
        </div>
        <div class="">
        </div>
    </div>
@endsection

@section('script')


@endsection
