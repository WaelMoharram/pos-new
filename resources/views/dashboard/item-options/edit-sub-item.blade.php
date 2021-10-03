@extends('adminlte::page')

@section('title', 'تعديل صنف فرعى')

@section('content_header')
    <h1>تعديل صنف فرعى  {{$subItem->name}}</h1>
@stop

@section('content')

    {!! Form::model($subItem,['method'=>'put','route'=>['item-options.save-sub-item',$subItem->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">


        <div class="form-group py-1 col-md-12">
            <label for="formInputRole"> اسم الصنف</label>
            {!! Form::text('name',null,['class'=>'form-control col',disable_on_edit(),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
            {{input_error($errors,'name')}}
        </div>

        <div class="form-group py-1 col-md-12">
            <label for="formInputRole"> رقم الباركود </label>
            {!! Form::text('barcode',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
            {{input_error($errors,'barcode')}}
        </div>

        <div class="form-group py-1 col-md-12">
            <label for="formInputRole"> حد الطلب للصنف </label>
            {!! Form::text('min_amount',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
            {{input_error($errors,'min_amount')}}
        </div>


        @component('partials.buttons._save_button',[])
        @endcomponent
    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
