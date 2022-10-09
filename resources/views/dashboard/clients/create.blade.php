@extends('adminlte::page')

@section('title', 'اضافة عميل جديد')

@section('content_header')
    <h1>اضافة عميل جديد</h1>
@stop

@section('content')

    {!! Form::open(['method'=>'post','route'=>'clients.store','class'=>'form','enctype' => 'multipart/form-data']) !!}
    @csrf()
    <div class="row">
        @include('dashboard.clients._form')
        @component('partials.buttons._save_button',[])
        @endcomponent
    </div>
    {!! Form::close() !!}

@stop
@section('plugins.Select2', true)

@section('css')
@stop

@section('js')
    <script>
        $('.select2').select2({
            dir:'rtl',
        });
    </script>
    @include('sweetalert::alert')
@stop
