@extends('adminlte::page')

@section('title', 'كارت صنف')

@section('content_header')
    <h1> حركة المخزون  {{$store->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['method'=>'get','class'=>'form','enctype' => 'multipart/form-data']) !!}

            <div class="row">
                {{-- ############# Date #############--}}
                <div class="form-group py-1 col-md-6">
                    <label for="date"> التاريخ   </label>
                    <div class="input-group date" id="from_date" data-target-input="nearest">

                        {{Form::text('from_date',request()->from_date ?? null,['class'=>'form-control mb-2 datetimepicker-input ','id'=>'date'])}}
                        {{input_error($errors,'from_date')}}

                    </div>
                </div>
                <div class="form-group py-1 col-md-6">
                    <label for="date"> التاريخ الي  </label>
                    <div class="input-group date" id="to_date" data-target-input="nearest">

                        {{Form::text('to_date',request()->to_date ?? null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'to_date'])}}
                        {{input_error($errors,'to_date')}}
                    </div>
                </div>

                <div class="form-group py-1 col-md-6">
                    <label for="name"> {{__('الاسم')}}</label>
                    {!! Form::text('name',request()->name ??null,['id'=>'name','class'=>'form-control col datetimepicker-input ','placeholder'=>__("الاسم")]) !!}
                    {{input_error($errors,'name')}}
                </div>

                <div class="form-group py-1 col-md-6">
                    <label for="barcode"> {{__('رقم الباركود')}}</label>
                    {!! Form::text('barcode',request()->barcode ??null,['id'=>'barcode','class'=>'form-control col  ','placeholder'=>__("رقم الباركود")]) !!}
                    {{input_error($errors,'barcode')}}
                </div>

                {{--                <div class="form-group py-1 col-md-6">--}}
                {{--                    <label for="sort_by"> الترتيب ب  </label>--}}
                {{--                    <div class="input-group " id="sort_by" >--}}

                {{--                        {{Form::select('sort_by',['report_amount_desc'=>'الاكثر مبيعا','report_amount'=>'الاقل مبيعا'],request()->sort_by ?? null,['class'=>'form-control mb-2','id'=>'sort_by'])}}--}}
                {{--                        {{input_error($errors,'sort_by')}}--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="form-group py-1 col-md-6">--}}
                {{--                    <label for="number"> عدد  الاصناف المعروضة  </label>--}}
                {{--                    <div class="input-group " id="number" >--}}

                {{--                        {{Form::select('number',['5'=>'5','10'=>'10','30'=>'30','50'=>'50','100'=>'100','all'=>'الكل'],request()->number ?? null,['class'=>'form-control mb-2','id'=>'number'])}}--}}
                {{--                        {{input_error($errors,'number')}}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="col-12">
                <button id="target" type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">فلترة</button>
                <a href="{{route('reports.store-card',$store->id)}}" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">اعادة تعيين</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {{-- Setup data for datatables --}}



    {{-- Minimal example / fill data using the component slot --}}

    <table id="table1" style="width:100%" class="table table-hover table-striped no-footer">
        <thead>
        <tr>
            <th rowspan="2">التاريخ</th>
            <th rowspan="2">رقم الصنف</th>
            <th rowspan="2">اسم الصنف</th>
            <th rowspan="2">نوع العملية </th>
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
        @if(request()->has('page') && request()->page >1)
            @foreach($details as $detail)
                @php

                    $date = new DateTime($detail->bill->date);
    $date->modify('-1 day');
    if (!isset($quantity[$detail->item_id])){
                        $quantity[$detail->item_id] = ItemAmountInStoreInDate($detail->item_id,$store->id,$date->format('Y-m-d'));
}
                @endphp

            @endforeach

        @else
            @if(request()->has('from_date') && request()->from_date != null)
                @foreach($details as $detail)
                    @php
                        $date = new DateTime(request()->from_date);
        $date->modify('-1 day');
                            $quantity[$detail->item_id] = ItemAmountInStoreInDate($detail->item_id,$store->id,$date->format('Y-m-d'));
                    @endphp
                @endforeach
            @endif
        @endif

        @foreach($details as $detail)
            <tr>
                @if($detail->bill->type != 'store')
                    <td>{{$detail->bill->date}}</td>
                    <td>{!! $detail->item->barcode !!}</td>
                    <td>{!! $detail->item->name !!}</td>
                    <td>{!! $detail->bill->type !!}</td>
                    @if($detail->bill->type == 'purchase_in'||$detail->bill->type == 'sale_in')
                        <td>{{number_format($detail->amount / ($detail->unit ?$detail->unit->ratio : 1) , 2) }}</td>
                        <td>{{number_format($detail->price , 2)}}</td>
                        <td>{{number_format($detail->amount * $detail->price , 2)}}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        @php($quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) +($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)))
                        <td>{{number_format($quantity[$detail->item_id] , 2)}}</td>
                        <td>{{$detail->price}}</td>
                        <td>{{number_format($total[$detail->item_id]= ($total[$detail->item_id] ?? 0)+(($detail->amount ) * $detail->price) , 2)}}</td>
                    @elseif($detail->bill->type == 'purchase_out'||$detail->bill->type == 'sale_out')
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{number_format($detail->amount / ($detail->unit ?$detail->unit->ratio : 1) , 2)}}</td>
                        <td>{{number_format($detail->buy_price , 2)}}</td>
                        <td>{{number_format((($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price) , 2)}}</td>
                        @php($quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) -($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)))
                        <td>{{number_format($quantity[$detail->item_id] , 2)}}</td>                <td>{{$detail->buy_price}}</td>
                        <td>{{number_format($total[$detail->item_id]= ($total[$detail->item_id]??0)-(($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price) , 2)}}</td>
                    @endif
                @endif
                @if($detail->bill->type == 'store')
                    @if($detail->bill->store_to_id == $store->id)

                        <td>{{$detail->bill->date}}</td>
                        <td>#{!! $detail->item->code !!}</td>

                        <td>#{!! $detail->item->name !!}</td>
                        <td>{!! $detail->bill->type !!}</td>

                        <td>{{number_format($detail->amount / ($detail->unit ?$detail->unit->ratio : 1) , 2)}}</td>
                        <td>{{number_format($detail->buy_price , 2)}}</td>
                        <td>{{number_format((($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price ), 2)}}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        @php($quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) +($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)))
                        <td>{{number_format($quantity[$detail->item_id] , 2)}}</td>                    <td>{{$detail->buy_price}}</td>
                        <td>{{number_format($total[$detail->item_id]= ($total[$detail->item_id] ?? 0)+(($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price) , 2)}}</td>
                    @endif
                    @if($detail->bill->store_from_id == $store->id)
                        <td>{{$detail->bill->date}}</td>
                        <td>#{!! $detail->item->code !!}</td>
                        <td>#{!! $detail->item->name !!}</td>
                        <td>{!! $detail->bill->type !!}</td>

                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{number_format(($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) , 2)}}</td>
                        <td>{{number_format($detail->buy_price , 2)}}</td>
                        <td>{{number_format((($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price) , 2)}}</td>
                        @php($quantity[$detail->item_id] = ($quantity[$detail->item_id]??0) -($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)))
                        <td>{{number_format($quantity[$detail->item_id] , 2)}}</td>                    <td>{{$detail->buy_price}}</td>
                        <td>{{number_format($total[$detail->item_id]= ($total[$detail->item_id] ?? 0)-(($detail->amount / ($detail->unit ?$detail->unit->ratio : 1)) * $detail->buy_price) , 2)}}</td>
                    @endif
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$details->appends(request()->except('page'))->links()}}





@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
