@extends('adminlte::page')

@section('title', 'عرض المخزن')

@section('content_header')
    عرض المخزن {{$store->name}}
    @stop

@section('content')
    {{-- Setup data for datatables --}}

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__('Filter')}}</h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="collapse" class="rotate"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    {!! Form::open(['method'=>'get','class'=>'form','enctype' => 'multipart/form-data']) !!}
                    <div class="row">
                        @include('dashboard.stores._form_show_filter')
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary   waves-effect waves-light">{{__('Filter')}}</button>
                            <a href="{{route('stores.show',$store->id)}}" class="  ml-1 btn btn-warning  waves-effect waves-light">{{__('Reset filter')}}</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


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
    <x-adminlte-datatable id="" :heads="$heads" striped hoverable with-buttons>
        @foreach($items as $itam)
            @php($amount = ItemAmountStore($store->id,optional($itam)->id))

        @if($amount != 0)
            <tr>
                <td>{!! optional($itam)->barcode!!}</td>
                <td>{!! optional($itam)->name !!}</td>
{{--                @php($amount = \App\Models\ItemStore::where('store_id',$store->id)->where('item_id',optional($itam)->id)->sum('amount'))--}}

                @php($amount = ItemAmountStore($store->id,optional($itam)->id))

                <td>
                    @php($unit = \App\Models\Unit::where('item_id',optional($itam)->id)->where('ratio',1)->first())

                    @php($amount = $amount * ((float)$unit->ratio))

                    @if(getRound($amount) != 0)
                        <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span>
                        @php($amount = getFrachtion(ItemAmountStore($store->id,optional($itam)->id)))
                    @endif
{{--                    @if($itam->id == 39)--}}
{{--                        @dd($amount)--}}
{{--                    @endif--}}
                </td>

                <td>
                    @if($amount != 0)
                    @foreach(\App\Models\Unit::where('item_id',optional($itam)->id)->where('ratio','!=',1)->orderBy('ratio')->get() as $unit)

                        @php($amount = $amount * ((float)$unit->ratio))
                        @if(getRound($amount) != 0)
                            <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span> @if(($loop->index +1) != \App\Models\Unit::where('item_id',($itam)->id)->where('ratio','!=',1)->count()) - @endif
                            @php($amount = getFrachtion(\App\Models\ItemStore::where('item_id',optional($itam)->id)->sum('amount')))
                        @endif
                    @endforeach
                        @endif
                </td>
            </tr>
            @endif
        @endforeach
    </x-adminlte-datatable>

    {{$items->appends(request()->except('page'))->links()}}






@stop

@section('css')

@stop

@section('js')

    @include('sweetalert::alert')
@stop
