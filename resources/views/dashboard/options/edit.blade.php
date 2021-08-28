@extends('adminlte::page')

@section('title', 'تعديل ')

@section('content_header')
    <h1>تعديل   {{$option->name}}</h1>
@stop

@section('content')

    {!! Form::model($option,['method'=>'put','route'=>['options.update',$option->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.options._form')
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
