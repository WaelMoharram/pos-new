@extends('adminlte::page')

@section('title', 'تعديل عميل')

@section('content_header')
    <h1>تعديل العميل  {{$client->name}}</h1>
@stop

@section('content')

    {!! Form::model($client,['method'=>'put','route'=>['clients.update',$client->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.clients._form')
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
