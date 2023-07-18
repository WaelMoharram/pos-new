@extends('adminlte::page')

@section('title', 'كارت صنف')

@section('content_header')
    <h1> كارت صنف {{$item->name}}</h1>
@stop

@section('content')

    {{-- Setup data for datatables --}}



    {{-- Minimal example / fill data using the component slot --}}
    <button  class="btn btn-info mr-1 mb-1" onclick="window.print()">طباعة</button>

    <table id="table1" style="width:100%;position: relative;
    overflow: auto;
    height: 300px;" class="table table-hover table-striped no-footer table-container" >
        <thead style="position: sticky;
    top: 0;
    background-color: #f5f5f5; /* Set the desired background color */
    font-weight: bold;">
        <tr>
            <th rowspan="2">التاريخ</th>
            <th rowspan="2">رقم المستند</th>
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
            $quantity = 0;
$price = 0;
$total=0;
        @endphp
        @foreach($details as $detail)
            @if($detail->bill->type !='store')
                <tr>
                    <td>{{$detail->bill->date}}</td>
                    <td>#{!! $detail->bill->code !!}</td>
                    @if($detail->bill->type == 'purchase_in'||$detail->bill->type == 'sale_in')
                        <td>{{($detail->amount / ($detail->unit ?$detail->unit->ratio : 1))}}</td>
                        <td>{{$detail->price}}</td>
                        <td>{{($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->price}}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        @php($quantity = $quantity +($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)))
                        <td>{{number_format($quantity, 2)}}</td>
                        <td>{{$detail->price}}</td>
                        <td>{{$quantity*$detail->price}}</td>
                    @elseif($detail->bill->type == 'purchase_out'||$detail->bill->type == 'sale_out')
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{($detail->amount / ($detail->unit ?$detail->unit->ratio : 1))}}</td>
                        <td>{{$detail->buy_price}}</td>
                        <td>{{($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price}}</td>
                        @php($quantity = $quantity -($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)))
                        <td>{{number_format($quantity, 2)}}</td>                <td>{{$detail->buy_price}}</td>
                        <td>{{$quantity*$detail->buy_price}}</td>
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
