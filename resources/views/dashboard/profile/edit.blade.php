@extends('adminlte::page')

@section('title', 'تعديل مستخدم')

@section('content_header')
    <h1>تعديل حسابى  {{$user->name}}</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($user,['method'=>'put','route'=>['profile.update'],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
    @csrf()
    <div class="row">
        @include('dashboard.profile._form')
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
