@extends('adminlte::page')

@section('title', 'عرض مندوب')

@section('content_header')
    <h1>عرض المندوب {{$user->name}}</h1>
@stop

@section('content')

    {!! Form::model($user,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.sales-men._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
