@extends('adminlte::page')

@section('title', 'اضافة مستخدم جديد')

@section('content_header')
    <h1>اضافة مستخدم جديد</h1>
@stop

@section('content')

    {!! Form::open(['method'=>'post','route'=>'users.store','class'=>'form','enctype' => 'multipart/form-data']) !!}
    @csrf()
    <div class="row">
        @include('dashboard.users._form')
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
