@extends('adminlte::page')

@section('title', 'مستخدمين النظام')

@section('content_header')
    <h1>مستخدمين النظام</h1>
    @can('add users')
        <a href="{{route('users.create')}}" class="btn btn-info float-right">اضافة جديد</a>
    @endcan
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'صورة المستخدم',
            'الاسم',
            ['label' => 'اسم المستخدم'],
            ['label' => 'البريد الالكترونى'],
            ['label' => 'الهاتف'],
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($users as $row)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td>@if($row->image)<img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;">@else <img src="{!! url('no.png') !!}" style="width: 100px; height: 100px;"> @endif</td>
                <td>{!! $row->name !!}</td>
                <td>{!! $row->username !!}</td>
                <td>{!! $row->email !!}</td>
                <td>{!! $row->mobile !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('users.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('users.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('users.show',$row->id) ,
                                            'tooltip' => 'تعديل',
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
