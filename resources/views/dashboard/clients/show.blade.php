@extends('adminlte::page')

@section('title', 'عرض بيانات عميل')

@section('content_header')
    <h1>عرض العميل {{$client->name}}</h1>
@stop

@section('content')

    {!! Form::model($client,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.clients._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
