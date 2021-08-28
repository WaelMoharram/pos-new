@extends('adminlte::page')

@section('title', 'تعديل مستخدم')

@section('content_header')
    <h1>تعديل المستخدم  {{$user->name}}</h1>
@stop

@section('content')

    {!! Form::model($user,['method'=>'put','route'=>['users.update',$user->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
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
