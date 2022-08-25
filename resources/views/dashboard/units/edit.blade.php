@extends('adminlte::page')

@section('title', 'تعديل الوحدة')

@section('content_header')
    <h1>تعديل الوحدة  {{$unit->name}}</h1>
@stop

@section('content')

    {!! Form::model($unit,['method'=>'put','route'=>['units.update',$unit->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.units._form')
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
