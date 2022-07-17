@extends('adminlte::page')

@section('title', 'عرض بيانات عميل')

@section('content_header')
    <h1>تقرير العميل {{$client->name}}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">    <h1> الرصيد الحالى : {{$total}}</h1>
        </div>
    </div>


    @php
        $heads = [
            '#',
            'العملية',
            'التاريخ',
            ['label' => 'له'],
            ['label' => 'عليه'],
            ['label' => 'نوع العملية'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($bills as $row)
            @if($row->type == 'sale_out')
            <tr>
                <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>فاتورة بيع رقم #{!! $row->code !!}</td>
                <td>{!! $row->date !!}</td>
                <td>0</td>
                <td>{!! $row->total !!}</td>
                <td>{!! $row->type_name !!}</td>
            </tr>
            @endif
            @if($row->type == 'sale_in')
                <tr>
                    <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                    <td>فاتورة مرتجع رقم #{!! $row->code !!}</td>
                    <td>{!! $row->date !!}</td>

                    <td>{!! $row->total !!}</td>
                    <td>0</td>
                    <td>{!! $row->type_name !!}</td>
                </tr>
            @endif

            @if($row->type == 'cash_in')
                <tr>
                    <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                    <td>سداد للفاتورة رقم #{!! optional($row->bill)->code !!}</td>                <td>{!! $row->date !!}</td>

                    <td>{!! $row->money !!}</td>
                    <td>0</td>
                    <td>{!! $row->type_name !!}</td>
                </tr>
            @endif
            @if($row->type == 'cash_out')
                <tr>
                    <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                    <td>سداد للمرتجع رقم #{!! optional($row->bill)->code !!}</td>                <td>{!! $row->date !!}</td>

                    <td>0</td>
                    <td>{!! $row->money !!}</td>
                    <td>{!! $row->type_name !!}</td>
                </tr>
            @endif
        @endforeach
    </x-adminlte-datatable>



@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
