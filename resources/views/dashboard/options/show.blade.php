@extends('adminlte::page')

@section('title', 'عرض اختيارات الاصناف')

@section('content_header')
    <h1>عرض  {{$option->name}}</h1>
@stop

@section('content')

    {!! Form::model($option,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.options._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
