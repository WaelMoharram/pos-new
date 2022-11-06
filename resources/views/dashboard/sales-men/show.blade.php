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
            ['label' => 'كمية الوحدة الاساسية'],
            ['label' => 'كمية الوحدات الفرعية'],
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
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! optional($itam->item)->name !!}</td>
                @php($amount = \App\Models\ItemStore::where('store_id',$store->id)->where('item_id',optional($itam->item)->id)->sum('amount'))

                <td>
                    @php($unit = \App\Models\Unit::where('item_id',($itam->item)->id)->where('ratio',1)->first())

                        @php($amount = $amount * ((float)$unit->ratio))
                        @if(getRound($amount) != 0)
                            <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span>
                            @php($amount = getFrachtion(\App\Models\ItemStore::where('item_id',($itam->item)->id)->sum('amount')))
                        @endif

                </td>

                <td>
                    @foreach(\App\Models\Unit::where('item_id',($itam->item)->id)->where('ratio','!=',1)->get() as $unit)

                        @php($amount = $amount * ((float)$unit->ratio))
                        @if(getRound($amount) != 0)
                            <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span> @if($loop->index +1 == \App\Models\Unit::where('item_id',($itam->item)->id)->where('ratio','!=',1)->count()) - @endif
                            @php($amount = getFrachtion(\App\Models\ItemStore::where('item_id',($itam->item)->id)->sum('amount')))
                        @endif
                    @endforeach
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
