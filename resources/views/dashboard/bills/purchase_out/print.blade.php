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
                        <h4>
                            <img src="{{asset('logo.png')}}" style="width:150px;">
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
                            <strong>بيانات فاتورة مرتجع مشتريات </strong><br>
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

                <div class="row">
                    <!-- accepted payments column -->
                {{--            <div class="col-6">--}}
                {{--                <p class="lead">Payment Methods:</p>--}}
                {{--                <img src="../../dist/img/credit/visa.png" alt="Visa">--}}
                {{--                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
                {{--                <img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
                {{--                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}

                {{--                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">--}}
                {{--                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem--}}
                {{--                    plugg--}}
                {{--                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                {{--                </p>--}}
                {{--            </div>--}}
                {{--            <!-- /.col -->--}}
                {{--            <div class="col-6">--}}
                {{--                <p class="lead">Amount Due 2/22/2014</p>--}}

                {{--                <div class="table-responsive">--}}
                {{--                    <table class="table">--}}
                {{--                        <tr>--}}
                {{--                            <th style="width:50%">Subtotal:</th>--}}
                {{--                            <td>$250.30</td>--}}
                {{--                        </tr>--}}
                {{--                        <tr>--}}
                {{--                            <th>Tax (9.3%)</th>--}}
                {{--                            <td>$10.34</td>--}}
                {{--                        </tr>--}}
                {{--                        <tr>--}}
                {{--                            <th>Shipping:</th>--}}
                {{--                            <td>$5.80</td>--}}
                {{--                        </tr>--}}
                {{--                        <tr>--}}
                {{--                            <th>Total:</th>--}}
                {{--                            <td>$265.24</td>--}}
                {{--                        </tr>--}}
                {{--                    </table>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                <!-- /.col -->
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

