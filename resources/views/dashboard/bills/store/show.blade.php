@extends('adminlte::page')

@section('title', 'تعديل فاتورة')

@section('content_header')
    <h1>اذن صرف رقم {{$bill->code}}</h1>
@stop

@section('content')

<div class="row">
    <div dir="rtl" class="invoice p-3 mb-3 col-12" id="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Company name.
                    <small class="float-right">التاريخ: {{$bill->date}}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">

                <address>
                    <strong>بيانات اذن الصرف</strong><br>
                   من مخرن {{optional($bill->storeFrom)->name}}<br>
                   الى مخرن {{optional($bill->storeTo)->name}}<br>
                    رقم الاذن #{{$bill->code}}<br>
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
                            <td>{{optional($detail->subItem)->name}}</td>
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
                    <tr>
                        <td>#</td>
                        <td colspan="3">الاجمالى</td>

                        <td>
                            {{$details->sum('total')}}
                        </td>


                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
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
