@extends('adminlte::page')

@section('title', 'الاصناف')

@section('content_header')
    <h1>الاصناف</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'صورة الصنف',
            'الاسم',
            'التصنيف',
            'العلامة التجارية',
            'الكود',
            'الباركود',
            'يحتوى على اختيارات ؟',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($items as $row)
            <tr>
                <td>{!! $loop->index +1 !!}</td>
                <td><img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;"></td>
                <td>{!! $row->name !!}</td>
                <td>{!! optional($row->category)->name !!}</td>
                <td>{!! optional($row->brand)->name !!}</td>
                <td>{!! $row->code !!}</td>
                <td>{!! $row->barcode !!}</td>
                <td>{!! $row->has_options ? 'نعم': 'لا' !!}</td>

                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('items.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('items.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('items.show',$row->id) ,
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
