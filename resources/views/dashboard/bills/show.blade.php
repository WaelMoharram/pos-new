@extends('adminlte::page')

@section('title', 'عرض الصنفة')

@section('content_header')
    <h1>عرض  {{$item->name}}</h1>
@stop

@section('content')

    {!! Form::model($item,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.items._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
