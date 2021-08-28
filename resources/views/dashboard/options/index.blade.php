@extends('adminlte::page')

@section('title', 'اختيارات الاصناف')

@section('content_header')
    <h1>اختيارات الاصناف</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'صورة الاختيار',
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
        @foreach($options as $row)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td><img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;"></td>
                <td>{!! $row->name !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('options.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('options.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('options.show',$row->id) ,
                                            'tooltip' => 'عرض',
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
