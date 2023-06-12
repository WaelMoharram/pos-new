@extends('adminlte::page')

@section('title', 'تقرير الأصناف الأكثر مبيعا خلال فترة')

@section('content_header')
    <h1>تقرير الأصناف الأكثر مبيعا خلال فترة</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['method'=>'get','class'=>'form','enctype' => 'multipart/form-data']) !!}

            <div class="row">
                {{-- ############# Date #############--}}
                <div class="form-group py-1 col-md-6">
                    <label for="date"> التاريخ من  </label>
                    <div class="input-group date" id="from_date" data-target-input="nearest">

                        {{Form::text('from_date',request()->from_date ?? null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'from_date'])}}
                        {{input_error($errors,'from_date')}}

                    </div>
                </div>
                {{-- ############# Date #############--}}
                <div class="form-group py-1 col-md-6">
                    <label for="date"> التاريخ الي  </label>
                    <div class="input-group date" id="to_date" data-target-input="nearest">

                        {{Form::text('to_date',request()->to_date ?? null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'to_date'])}}
                        {{input_error($errors,'to_date')}}
                    </div>
                </div>
                <div class="form-group py-1 col-md-6">
                    <label for="sort_by"> الترتيب ب  </label>
                    <div class="input-group " id="sort_by" >

                        {{Form::select('sort_by',['report_amount_desc'=>'الاكثر مبيعا','report_amount'=>'الاقل مبيعا'],request()->sort_by ?? null,['class'=>'form-control mb-2','id'=>'sort_by'])}}
                        {{input_error($errors,'sort_by')}}
                    </div>
                </div>

                <div class="form-group py-1 col-md-6">
                    <label for="number"> عدد  الاصناف المعروضة  </label>
                    <div class="input-group " id="number" >

                        {{Form::select('number',['5'=>'5','10'=>'10','30'=>'30','50'=>'50','100'=>'100','all'=>'الكل'],request()->number ?? null,['class'=>'form-control mb-2','id'=>'number'])}}
                        {{input_error($errors,'number')}}
                    </div>
                </div>
            </div>
                @component('partials.buttons._save_button',[])
                @endcomponent
            {!! Form::close() !!}
        </div>
    </div>
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الصنف',
            ['label' => 'كمية الوحدة الاساسية'],
            ['label' => 'كميات الوحدات الفرعية'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}

        <table id="table1" style="width:100%" class="table table-hover table-striped no-footer">
            <thead>
            <tr>
                <th>#</th>
                <th>الصنف</th>
                <th>كمية الوحدة الاساسية</th>
                <th>كميات الوحدات الفرعية</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $row)
                <tr>
                    <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                    <td>{!! $row->name !!}</td>
                    @php($amount = $row->report_amount)

                    <td>

                        @php($unit = \App\Models\Unit::where('item_id',$row->id)->where('ratio',1)->first())

                        @php($amount = $amount * ((float)$unit->ratio))

                        @if(getRound($amount) != 0)

                            <span class="btn btn-outline-info" {{tooltip($unit->name)}}>{{getRound($amount)}}</span>
                            @php($amount = (float)getFrachtion($row->report_amount))
                        @endif

                    </td>

                    <td>
                        @foreach(\App\Models\Unit::where('item_id',$row->id)->where('ratio','!=',1)->get() as $unit)

                            <span class="btn btn-outline-warning" {{tooltip($unit->name)}}>{{getRound(($amount * (float)$unit->ratio))}}</span>
                            @php($amount = getFrachtion(getRound(($amount * (float)$unit->ratio))))

                        @endforeach
                    </td>
                    {{--                <td>{!! $row->report_amount !!}</td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>






@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
