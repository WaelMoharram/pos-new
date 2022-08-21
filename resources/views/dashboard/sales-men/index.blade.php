@extends('adminlte::page')

@section('title', 'المندوبين')

@section('content_header')
    <h1>المندوبين</h1>
    @can('add sales_men')
        <a href="{{url('dashboard/sales-men/create')}}" class="btn btn-info float-right">اضافة جديد</a>
    @endcan
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            ['label' => 'صورة المستخدم', 'no-export' => true],
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
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>@if($row->image)<img src="{!! url('/').'/'.$row->image !!}" style="width: 100px; height: 100px;">@else <img src="{!! url('no.png') !!}" style="width: 100px; height: 100px;"> @endif</td>
                <td><a href="{{route('sales-men.report',$row->id)}}">{!! $row->name !!}</a></td>
                <td>{!! $row->username !!}</td>
                <td>{!! $row->email !!}</td>
                <td>{!! $row->mobile !!}</td>
                <td>



                                @component('partials.buttons._edit_button',[
                                        'route' => route('sales-men.edit',$row->id) ,
                                        'tooltip' => 'تعديل',
                                         ])
                                @endcomponent

                                @component('partials.buttons._delete_button',[
                                                'id'=>$row->id,
                                                'route' => route('sales-men.destroy',$row->id) ,
                                                'tooltip' => 'حذف',
                                                 ])
                                @endcomponent

                                    @component('partials.buttons._custom_button',[
                                                    'route' => route('sales-men.report',$row->id) ,
                                                    'tooltip' => 'عرض الحركات المالية',
                                                    'fa'=>'fa-money',
                                                    'color'=>'default',
                                                     ])
                                    @endcomponent

                                    @component('partials.buttons._custom_button',[
                                                    'route' => route('sales-men.show',$row->id) ,
                                                    'tooltip' => 'عرض المخزون',
                                                    'fa'=>'fa-file',
                                                    'color'=>'default',
                                                     ])
                                    @endcomponent

                                    @component('partials.buttons._custom_button',[
                                                    'route' => route('bills.index',['type'=>'sale_out','sales_man_id'=>$row->id]) ,
                                                    'tooltip' => 'عرض المبيعات',
                                                    'fa'=>'fa-file',
                                                    'color'=>'default',
                                                     ])
                                    @endcomponent

                                    @component('partials.buttons._custom_button',[
                                                    'route' => route('clients.index',['sales_man_id'=>$row->id]) ,
                                                    'tooltip' => 'عرض العملاء',
                                                    'fa'=>'fa-users',
                                                    'color'=>'default',
                                                     ])
                                    @endcomponent





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
