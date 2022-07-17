@extends('adminlte::page')

@section('title', 'فواتير البيع')

@section('content_header')
    <h1>فواتير البيع</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @if(request()->type == 'sale_out')
        @can('add sales')
    @component('partials.buttons._add_sale_bill_button',[
                                            'route' => route('bills.store',['type'=>'sale_out']) ,
                                            'tooltip' => 'اضافة',
                                            'store'=>$store
                                             ])
    @endcomponent
            @endcan
    @endif
    @php
        $heads = [
            '#',
            'التاريخ',
            'رقم الفاتورة',
            'اسم المورد',
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

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($bills as $row)
            <tr>
                <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! $row->date !!}</td>
                <td>{!! $row->code !!}</td>
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




@stop

@section('css')

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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

    @include('sweetalert::alert')
@stop
