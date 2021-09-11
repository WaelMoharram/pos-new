@extends('adminlte::page')

@section('title', 'تعديل صنف')

@section('content_header')
    <h1>تعديل صنف  {{$item->name}}</h1>
@stop

@section('content')

    {!! Form::model($item,['method'=>'put','route'=>['items.update',$item->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.items._form')
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
