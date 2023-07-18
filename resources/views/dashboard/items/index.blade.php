@extends('adminlte::page')

@section('title', 'الاصناف')

@section('content_header')
    <h1>الاصناف</h1>
    @can('add items')
        <a href="{{route('items.create')}}" class="btn btn-info float-right">اضافة جديد</a>
    @endcan
        <a href="{{route('export.units')}}" class="btn btn-info float-right">تحميل ملف الاكسل</a>
    @can('edit items')
        <button data-toggle="modal" data-target="#uploadExcel" class="info-box-icon bg-success" title="Upload" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>
            رفع تعديل السعر
        </button>
        <div class="modal fade text-left" id="uploadExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">رفع ملف الاسعار</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['method'=>'post','route'=>'import.units','class'=>'form','enctype' => 'multipart/form-data']) !!}

                            {{ csrf_field() }}
                            <div class="form-group col-md-12 {{hidden_on_show()}}">
                                <label for="logo_input"> ملف الاكسل </label>
                                {!! Form::file('file',['id'=>'logo_input','class'=>'form-control col','placeholder'=>__("File"),'required']) !!}
                                {{input_error($errors,'file')}}
                            </div>
                            <button type="submit" class="btn btn-success">رفع</button>

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>

    @endcan
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
                        @include('dashboard.items._form_show_filter')
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary   waves-effect waves-light">{{__('Filter')}}</button>
                            <a href="{{route('items.index')}}" class="  ml-1 btn btn-warning  waves-effect waves-light">{{__('Reset filter')}}</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

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
    <x-adminlte-datatable id="" :heads="$heads" striped hoverable with-buttons>
        @foreach($items as $row)
            <tr>

{{--                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>--}}
                <td>@if($row->image)<img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;">@else <img src="{!! url('no.png') !!}" style="width: 100px; height: 100px;"> @endif</td>
                <td><a href="{{route('reports.item-card',$row->id)}}">{!! $row->name !!}</a></td>
{{--                @php($amount = \App\Models\ItemStore::where('item_id',$row->id)->sum('amount'))--}}
                @php($amount = ItemAmount($row->id))

                <td>


                    @php($unit = \App\Models\Unit::where('item_id',$row->id)->where('ratio',1)->first())

                    @php($amount = $amount * ((float)$unit->ratio))
                    @if(getRound($amount) != 0)

                        <span {{tooltip($unit->name)}}>{{getRound($amount)}}</span>
                        @php($amount = (float)getFrachtion(ItemAmount($row->id)))

                    @endif

                </td>

                <td>
                    @foreach(\App\Models\Unit::where('item_id',$row->id)->where('ratio','!=',1)->orderBy('ratio')->get() as $unit)
                            @if(($loop->index +1) == 1)
                                    <span {{tooltip($unit->name)}}>{{getRound(($amount * (float)$unit->ratio))}}</span>
                                @else
                            <span {{tooltip($unit->name)}}>{{getRound(($amount * (  (float)$oldUnit->ratio / (float)$unit->ratio)   )  )}}</span>

                           @endif
                                @if(($loop->index +1) != \App\Models\Unit::where('item_id',$row->id)->where('ratio','!=',1)->count()) - @endif
                                    @php
                                    $amount = getFrachtion($amount);
                                    $oldUnit = $unit;
                                    @endphp


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
            {{$items->appends(request()->except('page'))->links()}}





        @stop

        @section('css')
        @stop

        @section('js')

            @include('sweetalert::alert')
        @stop
