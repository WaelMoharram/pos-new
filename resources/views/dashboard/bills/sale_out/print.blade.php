@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">


        <div class="row">
            <div dir="rtl" class="invoice p-3 mb-3 col-12" id="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <strong style="text-align: center;">اذن استلام مسعر </strong><br>

                        <h4>
                            <img class="float-right" src="{{asset('logo.png')}}" style="width:250px;">
                            <br>
                            <small class="float-left">التاريخ: {{$bill->date}}</small>
                            <br>
                            <small class="float-left">تاريخ انشاء الفاتورة: {{$bill->created_at}}</small>
                            <br>
                            <address>
                                مخرن {{optional($bill->store)->name}}<br>
                                عميل {{optional($bill->model)->name}}<br>
                                رقم الفاتورة #{{$bill->code}}<br>

                            </address>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped" dir="rtl" style="    text-align: right;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الصنف</th>
                                <th>الكمية</th>
                                <th>السعر </th>
                                <th>السعر بعد الخصم </th>

                                <th>الاجمالى</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $detail)
                                <tr>
                                    <td>{{substr(str_repeat(0, 5).($loop->index +1), - 5)}}</td>
                                    <td>{{optional($detail->item)->name}}</td>
                                    <td>
                                        {{$detail->amount}}
                                    </td>

                                    <td>
                                        {{$detail->old_price}}
                                    </td>

                                    <td>
                                        {{$detail->price}}
                                    </td>
                                    <td>
                                        {{$detail->total}}
                                    </td>


                                </tr>
                            @endforeach
                            @if($bill->tax != null || $bill->tax != 0 || $bill->discount != null || $bill->discount != 0)
                                <tr>
                                    <td>#</td>
                                    <th  colspan="4" style="width:50%">اجمالى الأصناف</th>
                                    <td>{{$details->sum('total')}}</td>
                                </tr>
                            @endif
                            @if($bill->tax != null || $bill->tax != 0)
                                <tr>
                                    <td>#</td>

                                    <th  colspan="4">{{$bill->tax_type ?? 0}}</th>
                                    <td>{{$bill->tax ?? 0}}</td>
                                </tr>
                            @endif
                            @if($bill->discount != null || $bill->discount != 0)
                                <tr>
                                    <td>#</td>

                                    <th colspan="4">{{$bill->discount_type ?? 0}}</th>
                                    <td>{{$bill->discount ?? 0}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>#</td>
                                <td colspan="4">الاجمالى</td>

                                <td>
                                    {{$bill->total}}
                                </td>


                            </tr>
                            <tr>
                                <td>#</td>
                                <td colspan="4">المدفوع</td>

                                <td>
                                    {!!  optional($bill->payments)->sum('money') ?? 0  !!}
                                </td>


                            </tr>
                            <tr>
                                <td>#</td>
                                <td colspan="4">المتبقى</td>

                                <td>
                                    {{$bill->remaining}}
                                </td>


                            </tr>

                            @component('dashboard.bills.payments',['bill'=>$bill])
                            @endcomponent
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
<hr>
                <div class="row text-center">
                    <div class="col-md-4"><span>توقيع مندوب الشركة</span></div>
                    <div class="col-md-4"><span> توقيع المستلم</span></div>
                    <div class="col-md-4"><span>ختم العميل</span></div>
{{--                    <div class="col-md-3"><span>رئيس مجلس الادارة</span></div>--}}
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
{{--                        <a href="{{route('bills.print',$bill->id)}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> طباعة الاذن</a>--}}
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

    </div>
@stop

@section('adminlte_js')


    @stack('js')
    @yield('js')
    @include('sweetalert::alert')
<script>
    window.print();
</script>
@stop

