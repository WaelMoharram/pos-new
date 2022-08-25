@extends('adminlte::page')

@section('title', 'اضافة وحدة جديدة')

@section('content_header')
    <h1>اضافة وحدة جديد</h1>
@stop

@section('content')

    {!! Form::open(['method'=>'post','route'=>'units.store','class'=>'form','enctype' => 'multipart/form-data']) !!}
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
