@extends('adminlte::page')

@section('title', 'المدفوعات ')

@section('content_header')
    <h1> المدفوعات</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'نوع الفاتورة',
            ['label' => 'رقم الفاتورة'],
            ['label' => 'المبلغ المسدد'],
            ['label' => 'نوع السداد'],
            ['label' => 'اعدادات'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($payments as $row)
            <tr>
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! optional($row->bill)->type_name !!}</td>
                <td>#{!! optional($row->bill)->code !!}</td>
                <td>{!! $row->money !!}</td>
                <td>{!! $row->type_name !!}</td>
                <td>

                    @can('delete payment')
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('clients.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent
                        @endcan
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
