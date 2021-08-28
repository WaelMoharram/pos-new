@extends('adminlte::page')

@section('title', 'عرض بيانات مورد')

@section('content_header')
    <h1>عرض المورد {{$supplier->name}}</h1>
@stop

@section('content')

    {!! Form::model($supplier,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.suppliers._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
