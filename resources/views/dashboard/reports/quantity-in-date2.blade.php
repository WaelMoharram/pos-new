@extends('adminlte::page')

@section('title', 'تقرير ارصدة المخزون خلال يوم معين')

@section('content_header')
    <h1> ارصدة المخزون فى {{request()->date}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['method'=>'get','class'=>'form','enctype' => 'multipart/form-data']) !!}

            <div class="row">
                {{-- ############# Date #############--}}
                <div class="form-group py-1 col-md-12">
                    <label for="date"> التاريخ   </label>
                    <div class="input-group date" id="from_date" data-target-input="nearest">

                        {{Form::text('date',request()->date ?? null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'date'])}}
                        {{input_error($errors,'date')}}

                    </div>
                </div>
{{--                --}}{{-- ############# Date #############--}}
{{--                <div class="form-group py-1 col-md-6">--}}
{{--                    <label for="date"> التاريخ الي  </label>--}}
{{--                    <div class="input-group date" id="to_date" data-target-input="nearest">--}}

{{--                        {{Form::text('to_date',request()->to_date ?? null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'to_date'])}}--}}
{{--                        {{input_error($errors,'to_date')}}--}}
{{--                    </div>--}}
{{--                </div>--}}
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
                @component('partials.buttons._save_button',[])
                @endcomponent
            {!! Form::close() !!}
        </div>
    </div>
    {{-- Setup data for datatables --}}



    {{-- Minimal example / fill data using the component slot --}}

        <table id="table1" style="width:100%" class="table table-hover table-striped no-footer">
            <thead>
            <tr>
                <th>رقم الصنف</th>
                <th>الصنف</th>
                <th>المخزن</th>
                <th>الرصيد</th>
                <th>القيمة</th>
                <th>متوسط سعر الوحدة</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $row)
                <tr>
                    <td>{{$row->barcode}}</td>
                    <td>{!! $row->name !!}</td>
                    <td>
                        @foreach(\App\Models\Store::where('sales_man_id',null)->get() as $store)
                            {{$store->name}}
                            <br>
                        @endforeach


                    </td>

                    <td>
                        @foreach(\App\Models\Store::where('sales_man_id',null)->get() as $store)
                            {{ItemAmountInStoreInDate($row->id,$store->id,request()->date??date('Y-m-d'))}}
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach(\App\Models\Store::where('sales_man_id',null)->get() as $store)
                            {{round((ItemAmountInStoreInDate($row->id,$store->id,request()->date??date('Y-m-d'))) * $row->buy_price, 2)}}
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach(\App\Models\Store::where('sales_man_id',null)->get() as $store)
                            @if(ItemAmountInStoreInDate($row->id,$store->id,request()->date??date('Y-m-d')) != 0)
                            {{round((ItemAmountInStoreInDate($row->id,$store->id,request()->date??date('Y-m-d'))) * (\App\Models\BillDetail::where('item_id',$row->id)->where('created_at','<=',request()->date??date('Y-m-d'))->latest()->first()->new_average_price ?? 0), 2)/ItemAmountInStoreInDate($row->id,$store->id,request()->date??date('Y-m-d'))}}

@else
    0
                            @endif

                            <br>
                        @endforeach
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    {{$items->appends(request()->except('page'))->links()}}





@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop