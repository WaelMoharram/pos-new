@extends('adminlte::page')

@section('title', 'عرض المخزن')

@section('content_header')
    عرض المخزن {{$store->name}}
    @stop

@section('content')
    {{-- Setup data for datatables --}}

    @php
        $heads = [
            '#',
            'الصنف',
            ['label' => 'الاصناف'],
            ['label' => 'الكمية'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach(\App\Models\StoreSubItem::where('store_id',$store->id)->get() as $itam)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td>{!! optional(optional($itam->subItem)->item)->name !!}</td>
                <td>{!! optional($itam->subItem)->name !!}</td>
                <td>{!! $itam->amount !!}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>





@stop

@section('css')

@stop

@section('js')

    @include('sweetalert::alert')
@stop
