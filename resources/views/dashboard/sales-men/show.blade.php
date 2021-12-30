@extends('adminlte::page')

@section('title', 'عرض مندوب')

@section('content_header')
    <h1>عرض المندوب {{$user->name}}</h1>
@stop

@section('content')

    {!! Form::model($user,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.sales-men._form')

    </div>
    {!! Form::close() !!}


    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الصنف',
            ['label' => 'الكمية'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach(\App\Models\ItemStore::where('store_id',$store->id)->get() as $itam)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td>{!! $itam->item->name !!}</td>
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
