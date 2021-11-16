@extends('adminlte::page')

@section('title', 'اضافة دور جديد')

@section('content_header')
    <h1>اضافة دور جديد</h1>
@stop

@section('content')

    {!! Form::open(['method'=>'post','route'=>'roles.store','class'=>'form','enctype' => 'multipart/form-data']) !!}
    @csrf()
    <div class="row">
        @include('dashboard.roles._form')
        @component('partials.buttons._save_button',[])
        @endcomponent
    </div>
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')
{{--    <script>--}}
{{--        $('.select2').select2({--}}
{{--            dir:'rtl',--}}
{{--        });--}}
{{--    </script>--}}
    @include('sweetalert::alert')
@stop
