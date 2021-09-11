@extends('adminlte::page')

@section('title', 'فواتير التوريد')

@section('content_header')
    <h1>فواتير التوريد</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'التاريخ',
            'رقم الفاتورة',
            'اسم المورد',
            'الاجمالى',
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
                <td>{!! $loop->index +1 !!}</td>
                <td>{!! $row->date !!}</td>
                <td>{!! $row->code !!}</td>
                <td>{!! optional($row->supplier)->name !!}</td>
                <td>{!! $row->total !!}</td>>

                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('bills.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('bills.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('bills.show',$row->id) ,
                                            'tooltip' => 'عرض',
                                             ])
                            @endcomponent
                    </nobr>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>





@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
