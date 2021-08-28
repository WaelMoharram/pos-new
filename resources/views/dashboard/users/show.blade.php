@extends('adminlte::page')

@section('title', 'عرض مستخدم')

@section('content_header')
    <h1>عرض المستخدم {{$user->name}}</h1>
@stop

@section('content')

    {!! Form::model($user,['class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.users._form')

    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
