@extends('adminlte::page')

@section('title', 'فواتير البيع')

@section('content_header')
    <h1>فواتير البيع</h1>
@stop

@section('content')
<script>

</script>

    {{-- Setup data for datatables --}}
    @if(request()->type == 'sale_out')
        @can('add sales')
{{--            @if (auth()->user()->store_id != null && auth()->user()->store->is_pos == 0)--}}
    @component('partials.buttons._add_sale_bill_button',[
                                            'route' => route('bills.store',['type'=>'sale_out']) ,
                                            'tooltip' => 'اضافة',
                                            'store'=>$store
                                             ])
    @endcomponent
{{--                @endif--}}
            @endcan
    @endif
    @php
        $heads = [
            '#',
            'التاريخ',
            'رقم الفاتورة',
            'المخزن',
            'اسم العميل',
            'الاجمالى',
            'المبلغ المسدد',
            'المبلغ المتبقى',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

<div class="row">
    <div class="col-md-12">
        {!! Form::open(['method'=>'get','class'=>'form','enctype' => 'multipart/form-data']) !!}

        <div class="row">
            @include('dashboard.bills.sale_out._form_filter')
        </div>
        <div class="col-12">
            <button id="target" type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">فلترة</button>
            <a href="{{route('bills.index',['type'=>'sale_out'])}}" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">اعادة تعيين</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="" :heads="$heads" striped hoverable with-buttons>
        @foreach($bills as $row)
            <tr>
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! $row->date !!}</td>
                <td>{!! $row->code !!}</td>
                <td>{!! optional($row->store)->name !!}</td>
                <td>{!! optional($row->model)->name !!}</td>
                <td>{!! $row->total ?? 0!!}</td>
                <td>{!! optional($row->payments)->sum('money') ?? 0!!}</td>
                <td>{!! $row->remaining ?? 0!!}</td>

                <td>
                    <nobr>
                        @if($row->remaining > 0)
                            @can('add payments')
                        @component('partials.buttons._payment_button',[
                                        'id'=>$row->id,
                                        'route' => route('payments.store',$row->id) ,
                                        'tooltip' => 'دقغ',
                                        'type'=>'cash_in'
                                         ])
                        @endcomponent
                                @endcan
                        @endif
                            @can('edit sales')
                        @component('partials.buttons._edit_button',[
                                        'route' => route('bills.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                            @endcan
                            @can('delete sales')
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('bills.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent
@endcan
                        @component('partials.buttons._show_button',[
                                        'route' => route('bills.show',$row->id) ,
                                        'tooltip' => 'عرض',
                                         ])
                        @endcomponent


                        @component('partials.buttons._print_button',[
                                        'route' => route('bills.print',$row->id) ,
                                        'tooltip' => 'طباعة',
                                         ])
                        @endcomponent
                    </nobr>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

{{$bills->appends(request()->except('page'))->links()}}



@stop

@section('css')


    <link rel="stylesheet" type="text/css" href="{{asset('assets/daterangepicker/daterangepicker.css')}} " />

@stop

@section('js')

    <script type="text/javascript" src="{{asset('assets/daterangepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        //moment.locale('ar');

        $(function() {
            $('.date').daterangepicker({
                singleDatePicker: true,
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "اختيار",
                    "cancelLabel": "الغاء",
                    "fromLabel": "من",
                    "toLabel": "الى",
                    "customRangeLabel": "Custom",
                    "daysOfWeek": [
                        "ح",
                        "ن",
                        "ث",
                        "ر",
                        "خ",
                        "ج",
                        "س"
                    ],
                    "monthNames": [
                        "يناير",
                        "فبرابر",
                        "مارس",
                        "ابريل",
                        "مابو",
                        "يونيو",
                        "يوليو",
                        "اغسطس",
                        "سبتمبر",
                        "اكتوبر",
                        "نوفمر",
                        "ديسمبر"
                    ],
                    "firstDay": 6
                }
            });
        });
    </script>
<script>
        $('.select2').select2({
            dir:'rtl',
            dropdownParent: $('#myModal')
        });
    </script>
    @include('sweetalert::alert')
@stop
