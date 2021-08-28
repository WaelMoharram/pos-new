@extends('adminlte::page')

@section('title', 'عرض بيانات مخزن')

@section('content_header')
    <h1>عرض المخزن {{$store->name}}</h1>
@stop

@section('content')

    {!! Form::model($store,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.stores._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
