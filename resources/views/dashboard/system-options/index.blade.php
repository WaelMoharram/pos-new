@extends('adminlte::page')

@section('title', 'الاعدادات')

@section('content_header')
    <h1>الاعدادات</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
            'القيمة',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($options as $row)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td>{!! $row->key !!}</td>
                <td>{!! $row->value !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('system-options.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
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
