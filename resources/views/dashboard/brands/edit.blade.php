@extends('adminlte::page')

@section('title', 'تعديل علامة تجارية')

@section('content_header')
    <h1>تعديل العلامة تجارية  {{$brand->name}}</h1>
@stop

@section('content')

    {!! Form::model($brand,['method'=>'put','route'=>['brands.update',$brand->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.brands._form')
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
