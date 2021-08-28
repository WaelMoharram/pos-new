@extends('adminlte::page')

@section('title', 'عرض تصنيف')

@section('content_header')
    <h1>عرض التصنيف {{$category->name}}</h1>
@stop

@section('content')

    {!! Form::model($category,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.categories._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
