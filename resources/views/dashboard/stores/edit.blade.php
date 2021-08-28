@extends('adminlte::page')

@section('title', 'تعديل مخزن')

@section('content_header')
    <h1>تعديل المخزن  {{$store->name}}</h1>
@stop

@section('content')

    {!! Form::model($store,['method'=>'put','route'=>['stores.update',$store->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.stores._form')
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
