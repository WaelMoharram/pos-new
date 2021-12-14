@extends('adminlte::page')

@section('title', 'تصنيفات الأصناف')

@section('content_header')
    <h1>تصنيفات الأصناف</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'صورة التصنيف',
            'الاسم',
            'التصنيف الاعلى',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($categories as $row)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td><img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;"></td>
                <td>{!! $row->name !!}</td>
                <td>{!! $row->category->name ?? 'لا يوجد' !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('categories.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('categories.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('categories.show',$row->id) ,
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
