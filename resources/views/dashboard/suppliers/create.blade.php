@extends('adminlte::page')

@section('title', 'اضافة مورد جديد')

@section('content_header')
    <h1>اضافة مورد جديد</h1>
@stop

@section('content')

    {!! Form::open(['method'=>'post','route'=>'suppliers.store','class'=>'form','enctype' => 'multipart/form-data']) !!}
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
