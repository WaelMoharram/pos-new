@extends('adminlte::page')

@section('title', 'عرض فاتورة')

@section('content_header')
    <h1>فاتورة مشتريات  رقم {{$bill->code}}</h1>
@stop

@section('content')

<div class="row">
    <div dir="rtl" class="invoice p-3 mb-3 col-12" id="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <img src="{{asset('logo.png')}}" style="width:250px;">
                    {{--                            <i class="fas fa-globe"></i> {{option('اسم الشركة')}}.--}}
                    <small class="float-right">التاريخ: {{$bill->date}}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">

                <address>
                    <strong>بيانات فاتورة مشتريات </strong><br>
                    مخرن {{optional($bill->store)->name}}<br>
                    مورد {{optional($bill->model)->name}}<br>
                    رقم الفاتورة #{{$bill->code}}<br>
                    {{--                    San Francisco, CA 94107<br>--}}
                    {{--                    Phone: (804) 123-5432<br>--}}
                    {{--                    Email: info@almasaeedstudio.com--}}
                </address>
            </div>
            <!-- /.col -->
{{--            <div class="col-sm-4 invoice-col">--}}
{{--                تحويل الى--}}
{{--                <address>--}}
{{--                   # <strong>{{optional($bill->storeTo)->name}}</strong><br>--}}
{{--                    795 Folsom Ave, Suite 600<br>--}}
{{--                    San Francisco, CA 94107<br>--}}
{{--                    Phone: (555) 539-1037<br>--}}
{{--                    Email: john.doe@example.com--}}
{{--                </address>--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-sm-4 invoice-col">--}}
{{--                <b>رقم الاذن #{{$bill->code}}</b><br>--}}
{{--                <br>--}}
{{--                <b>Order ID:</b> 4F3S8J<br>--}}
{{--                <b>Payment Due:</b> 2/22/2014<br>--}}
{{--                <b>Account:</b> 968-34567--}}
{{--            </div>--}}
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped" dir="rtl" style="    text-align: right;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الصنف</th>
                        <th>الكمية</th>
                        <th>سعر الوحدة</th>

                        <th>الاجمالى</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{optional($detail->item)->name}}</td>
                            <td>
                                {{$detail->amount}}
                            </td>

                            <td>
                                {{$detail->total/$detail->amount}}
                            </td>
                            <td>
                                {{$detail->total}}
                            </td>


                        </tr>
                    @endforeach
                    @if($bill->tax != null || $bill->tax != 0 || $bill->discount != null || $bill->discount != 0)
                        <tr>
                            <td>#</td>
                            <th  colspan="3" style="width:50%">اجمالى الأصناف</th>
                            <td>{{$details->sum('total')}}</td>
                        </tr>
                    @endif
                    @if($bill->tax != null || $bill->tax != 0)
                        <tr>
                            <td>#</td>

                            <th  colspan="3">{{$bill->tax_type ?? 0}}</th>
                            <td>{{$bill->tax ?? 0}}</td>
                        </tr>
                    @endif
                    @if($bill->discount != null || $bill->discount != 0)
                        <tr>
                            <td>#</td>

                            <th colspan="3">{{$bill->discount_type ?? 0}}</th>
                            <td>{{$bill->discount ?? 0}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>#</td>
                        <td colspan="3">الاجمالى</td>

                        <td>
                            {{$bill->total}}
                        </td>


                    </tr>
                    <tr>
                        <td>#</td>
                        <td colspan="3">المدفوع</td>

                        <td>
                            {!!  optional($bill->payments)->sum('money') ?? 0  !!}
                        </td>


                    </tr>
                    <tr>
                        <td>#</td>
                        <td colspan="3">المتبقى</td>

                        <td>
                            {{$bill->remaining}}
                        </td>


                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <hr>
        <div class="row text-center">
            <div class="col-md-3"><span>توقيع المندوب</span></div>
            <div class="col-md-3"><span>ادارة المخازن</span></div>
            <div class="col-md-3"><span>المدير المالى</span></div>
            <div class="col-md-3"><span>رئيس مجلس الادارة</span></div>
        </div>
        <!-- /.row -->
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <a href="{{route('bills.print',$bill->id)}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> طباعة الاذن</a>
{{--                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit--}}
{{--                    Payment--}}
{{--                </button>--}}
{{--                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
{{--                    <i class="fas fa-download"></i> Generate PDF--}}
{{--                </button>--}}
            </div>
        </div>
    </div>
</div>
@stop
@section('plugins.Select2', true)
@section('css')
@stop

@section('js')
    <script>
        $('.select2').select2({
           dir:'rtl',
        });
    </script>
    @include('sweetalert::alert')

@stop
