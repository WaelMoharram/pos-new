@extends('adminlte::page')

@section('title', 'عرض اجمالى المخزون')

@section('content_header')
    عرض اجمالى المخزون
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الصنف',
            ['label' => 'الكمية'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            //'paging' =>false,
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable with-buttons>
        @foreach(\App\Models\item::all() as $itam)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td>{!! $itam->name !!}</td>
                <td>{!! $itam->amount !!}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>





@stop

@section('css')
   {{-- <style>
        #table1_filter{
            display: none;
        }
    </style>--}}
@stop

@section('js')

    @include('sweetalert::alert')
@stop
