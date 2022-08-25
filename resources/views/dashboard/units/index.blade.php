@extends('adminlte::page')

@section('title', 'الوحدات')

@section('content_header')
    @can('add items')
        <a href="{{route('units.create',['item_id'=>request()->item_id])}}" class="btn btn-info float-right">اضافة جديد</a>
    @endcan
@stop

@section('content')
    {{-- Setup data for datatables --}}
    <br>
    <div class="row">
        @foreach($units as $unit)
            <div class="col-md-12 col-sm-12 col-12">
                <div class="info-box shadow-none">
                    <div class="info-box-content">
                        <span class="info-box-text">{{$unit->name}}</span>
                        <span class="info-box-number">{{$unit->price}} جنيه</span>
                        <span class="info-box-number">{{$unit->ratio}} معامل التحويل</span>
                    </div>
                    @if($unit->for == 'sales_man')
                        <a href="{{route('units.for-sales-man',$unit->id)}}" class="info-box-icon bg-secondary"><i class="fa fa-home"></i></a>
                        <span class="info-box-icon bg-info"><i class="fa fa-file"></i></span>
                    @elseif($unit->for == 'pos')
                        <span class="info-box-icon bg-success"><i class="fa fa-home"></i></span>
                        <a href="{{route('units.for-pos',$unit->id)}}" class="info-box-icon bg-secondary"><i class="fa fa-file"></i></a>
                    @else
                        <a href="{{route('units.for-pos',$unit->id)}}" class="info-box-icon bg-secondary"><i class="fa fa-home"></i></a>
                        <a href="{{route('units.for-sales-man',$unit->id)}}" class="info-box-icon bg-secondary"><i class="fa fa-file"></i></a>
                    @endif
                    @if($unit->ratio != 1)
                        @component('partials.buttons._edit_unit_button',[
                                        'route' => route('units.edit',$unit->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent

                        @component('partials.buttons._delete_unit_button',[
                                                'id'=>$unit->id,
                                                'route' => route('units.destroy',$unit->id) ,
                                                'tooltip' => 'حذف',
                                                 ])
                        @endcomponent
                    @endif


                </div>

            </div>
        @endforeach

    </div>






@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
