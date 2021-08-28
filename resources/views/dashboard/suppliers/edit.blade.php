@extends('adminlte::page')

@section('title', 'تعديل مورد')

@section('content_header')
    <h1>تعديل المورد  {{$supplier->name}}</h1>
@stop

@section('content')

    {!! Form::model($supplier,['method'=>'put','route'=>['suppliers.update',$supplier->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.suppliers._form')
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
