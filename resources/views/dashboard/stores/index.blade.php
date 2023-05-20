@extends('adminlte::page')

@section('title', 'المخازن')

@section('content_header')
المخازن
@can('add stores')
    <a href="{{route('stores.create')}}" class="btn btn-info float-right">اضافة جديد</a>
@endcan
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
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
        @foreach($stores as $row)
            <tr>
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>{!! $row->name !!}</td>
                <td>{!! $row->address !!}</td>
                <td>
                    <nobr>
                        @component('partials.buttons._edit_button',[
                                        'route' => route('stores.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                        @endcomponent
                        @component('partials.buttons._delete_button',[
                                        'id'=>$row->id,
                                        'route' => route('stores.destroy',$row->id) ,
                                        'tooltip' => 'حذف',
                                         ])
                        @endcomponent

                            @component('partials.buttons._show_button',[
                                            'route' => route('stores.show',$row->id) ,
                                            'tooltip' => 'تعديل',
                                             ])
                            @endcomponent



                            @can('sales reports')

                                @component('partials.buttons._custom_button',[
                                                'route' => route('bills.index',['type'=>'sale_out','store_id'=>$row->id]) ,
                                                'tooltip' => 'عرض المبيعات',
                                                'fa'=>'fa-chart-pie',
                                                'color'=>'default',
                                                 ])
                                @endcomponent
                            @endcan
                            @can('client reports')

                                @component('partials.buttons._custom_button',[
                                                'route' => route('clients.index',['store_id'=>$row->id]) ,
                                                'tooltip' => 'عرض العملاء',
                                                'fa'=>'fa-users',
                                                'color'=>'default',
                                                 ])
                                @endcomponent
                            @endcan




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
