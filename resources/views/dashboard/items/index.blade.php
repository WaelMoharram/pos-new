@extends('adminlte::page')

@section('title', 'الاصناف')

@section('content_header')
    <h1>الاصناف</h1>
    @can('add items')
        <a href="{{route('items.create')}}" class="btn btn-info float-right">اضافة جديد</a>
    @endcan
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'صورة الصنف',
            'الاسم',
            'كمية الوحدة الاساسية',
            'كمية الوحدات الفرعة',
            'التصنيف',
            'العلامة التجارية',
            'الباركود',
            'سعر الشراء',
            'سعر البيع',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
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

{{--                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>--}}
                <td>@if($row->image)<img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;">@else <img src="{!! url('no.png') !!}" style="width: 100px; height: 100px;"> @endif</td>
                <td>{!! $row->name !!}</td>
                @php($amount = \App\Models\ItemStore::where('item_id',$row->id)->sum('amount'))

                <td>
                    {{$amount}} 11111
                    @php($unit = \App\Models\Unit::where('item_id',$row->id)->where('ratio',1)->first())

                    @php($amount = $amount * ((float)$unit->ratio))
                    {{$amount}} 22222
                    @if(getRound($amount) != 0)
                        {{getRound($amount)}} 33333
                        <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span>
                        @php($amount = getFrachtion(\App\Models\ItemStore::where('item_id',$row->id)->sum('amount')))
                    @endif

                </td>

                <td>
                    @foreach(\App\Models\Unit::where('item_id',$row->id)->where('ratio','!=',1)->get() as $unit)
                        {{$amount}} 11111
                    {{$amount * $unit->ratio}}***
                        @php($number = $amount * $unit->ratio)
                        {{$number}} 22222
                        @if(getRound((float)$number) != 0)
                            {{getRound($number)}} 33333
                            <span {{tooltip($unit->name)}}>{{getRound($number)}}</span> @if(($loop->index +1) != \App\Models\Unit::where('item_id',$row->id)->where('ratio','!=',1)->count()) - @endif
                            @php($amount = getFrachtion(\App\Models\ItemStore::where('item_id',$row->id)->sum('amount')))
                        @endif
                    @endforeach
                </td>
                <td>{!! optional($row->category)->name !!}</td>
                <td>{!! optional($row->brand)->name !!}</td>
                <td>{!! $row->barcode !!}</td>
                <td>{!! $row->buy_price !!}</td>
                <td>{!! $row->price !!}</td>
{{--                <td>{!! $row->has_options ? 'نعم': 'لا' !!}</td>--}}

                <td>
                    <nobr>

                        @component('partials.buttons._edit_button',[
                                        'route' => route('items.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('items.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('items.show',$row->id) ,
                                            'tooltip' => 'عرض',
                                             ])
                            @endcomponent

                            @component('partials.buttons._barcode_button',[
                                            'id'=>$row->id,
                                            'route' => route('items.print-barcode',$row->id) ,
                                            'tooltip' => 'طباعة الباركود',
                                             ])
                            @endcomponent

                            @component('partials.buttons._units_button',[
                                            'route' => route('units.index',['item_id'=>$row->id]) ,
                                            'tooltip' => 'الوحدات',
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
