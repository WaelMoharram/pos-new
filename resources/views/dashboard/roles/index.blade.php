@extends('adminlte::page')

@section('title', 'ادوار المستخدمين')

@section('content_header')
    <h1> ادوار المستخدمين</h1>
    @can('edit users')
        <a href="{{route('roles.create')}}" class="btn btn-info float-right">اضافة جديد</a>
    @endcan
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($roles as $row)
            <tr>
                <td>{!! $substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! $row->name !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('roles.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('roles.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

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
