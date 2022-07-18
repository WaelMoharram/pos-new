@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>الرئيسية</h1>
@stop

@section('content')
    @if(auth()->user()->pos ==1)
        <a href="{{route('pos')}}" class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h2>نقطة بيع اليوم</h2>
                </div>

            </div>
        </a>
    @endif
@if($onLineCount > 1)
    <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$onLineCount}}</h3>

                <p>اصناف وصلت للحد الادنى للمخزون</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('alert-items',['type'=>'same'])}}" class="small-box-footer">عرض <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
@endif
@if($underLineCount > 1)
    <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$underLineCount}}</h3>

                <p>اصناف تجاوزت الحد الادنى للمخزون</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('alert-items',['type'=>'under'])}}" class="small-box-footer">عرض <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
@endif
{{--    <p>أخر عمليات المندوبين  <span style="color:#e74848;">مباشر</span> </p>--}}
{{--    <div class="row">--}}

{{--        <div class="callout callout-info col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-danger col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-warning col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-success col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}


{{--        <div class="callout callout-info col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-danger col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-warning col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-success col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-info col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-danger col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-warning col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-success col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-info col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-danger col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-warning col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}

{{--        <div class="callout callout-success col-12">--}}
{{--            <h5>اسم العملية</h5>--}}

{{--            <p>تقاصيل العملية</p>--}}
{{--        </div>--}}
{{--    </div>--}}
@stop

@section('css')
{{--    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/admin_custom.css') }}">
@stop

@section('js')
{{--    <script> console.log('Hi!'); </script>--}}
    <!-- Bootstrap 4 rtl -->
{{--    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>--}}
    <!-- Bootstrap 4 -->
<script>
    $( "#target" ).click(function() {
        $( "#target" ).addClass( "disabled" );
    });
</script>

@stop
