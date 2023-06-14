@extends('adminlte::page')

@section('title', 'كارت صنف')

@section('content_header')
    <h1> حركة المخزون  {{$store->name}}</h1>
@stop

@section('content')

    {{-- Setup data for datatables --}}



    {{-- Minimal example / fill data using the component slot --}}

        <table id="table1" style="width:100%" class="table table-hover table-striped no-footer">
            <thead>
            <tr>
                <th rowspan="2">التاريخ</th>
                <th rowspan="2">رقم الصنف</th>
                <th rowspan="2">اسم الصنف</th>
                <th colspan="3"> اضافة</th>
                <th colspan="3"> صرف</th>
                <th colspan="3"> رصيد</th>
            </tr>
            <tr>
                <th> كمية</th>
                <th> سعر الوحدة</th>
                <th> قيمة</th>
                <th> كمية</th>
                <th> سعر الوحدة</th>
                <th> قيمة</th>
                <th> كمية</th>
                <th> سعر الوحدة</th>
                <th> قيمة</th>
            </tr>
            </thead>
            <tbody>
            @php
            $quantity = [];
$price = [];
$total=[];
            @endphp
            @foreach($details as $detail)
        <tr>
            @if($detail->bill->type != 'store')
            <td>{{$detail->bill->date}}</td>
            <td>#{!! $detail->item->code !!}</td>
            <td>#{!! $detail->item->name !!}</td>
            @if($detail->bill->type == 'purchase_in'||$detail->bill->type == 'sale_in')
                <td>{{$detail->amount}}</td>
                <td>{{$detail->price}}</td>
                <td>{{$detail->amount * $detail->price}}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{$quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) +$detail->amount}}</td>
                <td>{{$detail->price}}</td>
                <td>{{$total[$detail->item_id]= ($total[$detail->item_id] ?? 0)+($detail->amount * $detail->price)}}</td>
            @elseif($detail->bill->type == 'purchase_out'||$detail->bill->type == 'sale_out')
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{{$detail->amount}}</td>
                <td>{{$detail->price}}</td>
                <td>{{$detail->amount * $detail->price}}</td>
                <td>{{$quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) -$detail->amount}}</td>
                <td>{{$detail->price}}</td>
                <td>{{$total[$detail->item_id]= ($total[$detail->item_id]??0)-($detail->amount * $detail->price)}}</td>
            @endif
            @endif
            @if($detail->bill->type == 'store')
                @if($detail->bill->stor_to_id == $store->id)
                    <td>{{$detail->bill->date}}</td>
                    <td>#{!! $detail->item->code !!}</td>
                    <td>#{!! $detail->item->name !!}</td>
                    <td>{{$detail->amount}}</td>
                    <td>{{$detail->price}}</td>
                    <td>{{$detail->amount * $detail->price}}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{$quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) +$detail->amount}}</td>
                    <td>{{$detail->price}}</td>
                    <td>{{$total[$detail->item_id]= ($total[$detail->item_id] ?? 0)+($detail->amount * $detail->price)}}</td>
                @endif
                @if($detail->bill->stor_from_id == $store->id)
                        <td>{{$detail->bill->date}}</td>
                        <td>#{!! $detail->item->code !!}</td>
                        <td>#{!! $detail->item->name !!}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{$detail->amount}}</td>
                    <td>{{$detail->price}}</td>
                    <td>{{$detail->amount * $detail->price}}</td>
                    <td>{{$quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) -$detail->amount}}</td>
                    <td>{{$detail->price}}</td>
                    <td>{{$total[$detail->item_id]= ($total[$detail->item_id] ?? 0)-($detail->amount * $detail->price)}}</td>
                @endif
            @endif

        </tr>
    @endforeach
    </tbody>
</table>
{{--{{$details->appends(request()->except('page'))->links()}}--}}





@stop

@section('css')
@stop

@section('js')

@include('sweetalert::alert')
@stop
