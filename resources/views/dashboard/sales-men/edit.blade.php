@extends('adminlte::page')

@section('title', 'تعديل مندوب')

@section('content_header')
    <h1>تعديل المندوب  {{$user->name}}</h1>
@stop

@section('content')

    {!! Form::model($user,['method'=>'put','route'=>['sales-men.update',$user->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.sales-men._form')
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
