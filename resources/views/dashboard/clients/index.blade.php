@extends('adminlte::page')

@section('title', 'العملاء')

@section('content_header')
العملاء
@can('add client')
    <a href="{{route('clients.create')}}" class="btn btn-info float-right">اضافة جديد</a>
@endcan
@stop
@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
            ['label' => 'الهاتف'],
            ['label' => 'العنوان'],
            ['label' => 'المندوب التابع له'],
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($clients as $row)
            <tr>
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td><a href="{{route('clients.report',$row->id)}}">{!! $row->name !!}</a></td>
                <td>{!! $row->phone !!}</td>
                <td>{!! $row->address !!}</td>
                <td>{!! optional($row->salesMan)->name !!}</td>
                <td>
                    @if($row->id != 1)
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('clients.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('clients.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('clients.show',$row->id) ,
                                            'tooltip' => 'عرض',
                                             ])
                            @endcomponent
                    </nobr>
                        @endif
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
