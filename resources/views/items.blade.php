@extends('adminlte::page')

@section('title', 'الاصناف')

@section('content_header')
    <h1>الاصناف</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
            'الحد الادنى للطلب',
            'العدد الفعلى',
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($items as $row)
            <tr>
                <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! $row->name_w_category !!}</td>
                <td>{!! $row->min_amount !!}</td>
                <td>{!! $row->amount !!}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>





@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
