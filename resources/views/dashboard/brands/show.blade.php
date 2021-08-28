@extends('adminlte::page')

@section('title', 'عرض علامة تجارية')

@section('content_header')
    <h1>عرض العلامة تجارية {{$brand->name}}</h1>
@stop

@section('content')

    {!! Form::model($brand,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.brands._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
