@extends('adminlte::page')

@section('title', 'مستخدمين النظام')

@section('content_header')
    <h1>مستخدمين النظام</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'الاسم',
            ['label' => 'اسم المستخدم'],
            ['label' => 'البريد الالكترونى'],
            ['label' => 'الهاتف'],
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];

        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                           <i class="fa fa-lg fa-fw fa-eye"></i>
                       </button>';

        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($users as $row)
            <tr>
                <td>{!! $row->name !!}</td>
                <td>{!! $row->username !!}</td>
                <td>{!! $row->email !!}</td>
                <td>{!! $row->mobile !!}</td>
                <td>
                    <nobr>
                        <a href="{{route('users.edit',$row->id)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <a class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </a>
                        <a href="{{route('users.show',$row->id)}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                    </nobr>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>





@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
