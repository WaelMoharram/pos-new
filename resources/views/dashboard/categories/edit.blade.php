@extends('adminlte::page')

@section('title', 'تعديل تصنيف')

@section('content_header')
    <h1>تعديل التصنيف  {{$category->name}}</h1>
@stop

@section('content')

    {!! Form::model($category,['method'=>'put','route'=>['categories.update',$category->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.categories._form')
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
