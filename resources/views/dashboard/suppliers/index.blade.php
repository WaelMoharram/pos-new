@extends('adminlte::page')

@section('title', 'الموردون')

@section('content_header')
الموردون@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
            ['label' => 'الهاتف'],
            ['label' => 'العنوان'],
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($suppliers as $row)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td><a href="{{route('suppliers.report',$row->id)}}">{!! $row->name !!}</a></td>
                <td>{!! $row->phone !!}</td>
                <td>{!! $row->address !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('suppliers.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('suppliers.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('suppliers.show',$row->id) ,
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
