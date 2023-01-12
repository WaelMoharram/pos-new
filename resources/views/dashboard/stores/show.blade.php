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
            @php($amount = ItemAmountStore($store->id,optional($itam->item)->id))

        @if($amount != 0)
            <tr>
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! optional($itam->item)->name !!}</td>
{{--                @php($amount = \App\Models\ItemStore::where('store_id',$store->id)->where('item_id',optional($itam->item)->id)->sum('amount'))--}}

                @php($amount = ItemAmountStore($store->id,optional($itam->item)->id))

                <td>
                    @php($unit = \App\Models\Unit::where('item_id',optional($itam->item)->id)->where('ratio',1)->first())

                    @php($amount = $amount * ((float)$unit->ratio))

                    @if(getRound($amount) != 0)
                        <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span>
                        @php($amount = getFrachtion(ItemAmountStore($store->id,optional($itam->item)->id)))
                    @endif
                    @if($itam->item->id == 39)
                        @dd($amount)
                    @endif
                </td>

                <td>
                    @if($amount != 0)
                    @foreach(\App\Models\Unit::where('item_id',optional($itam->item)->id)->where('ratio','!=',1)->orderBy('ratio')->get() as $unit)

                        @php($amount = $amount * ((float)$unit->ratio))
                        @if(getRound($amount) != 0)
                            <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span> @if(($loop->index +1) != \App\Models\Unit::where('item_id',($itam->item)->id)->where('ratio','!=',1)->count()) - @endif
                            @php($amount = getFrachtion(\App\Models\ItemStore::where('item_id',optional($itam->item)->id)->sum('amount')))
                        @endif
                    @endforeach
                        @endif
                </td>
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
