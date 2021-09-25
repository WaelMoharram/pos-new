@extends('adminlte::page')

@section('title', 'أختيارات الصنف ')

@section('content_header')
    <h1>اختيارات الصنف {{$itemName}}</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الاسم',
            'القيم المتاحة',
            ['label' => 'اعدادات', 'no-export' => true, 'width' => 5],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    <div class="card">
        <div class="card-header">

            <div class="card-tools">
                <ul class="nav nav-pills ml-auto" dir="rtl">
                    @if($canNotMakeActions == 0)

                    <li class="nav-item">
                        @component('partials.buttons._add_option_button',[
                                                    'route' => route('item-options.store',request()->item_id) ,
                                                    'tooltip' => 'الاختيارات للصنف',
                                                    'id'=>request()->item_id,
                                                    'forSelectOptions'=>$forSelectOptions
                                                     ])
                        @endcomponent
                    </li>
                    <li class="nav-item mr-5">
                        @component('partials.buttons._item_submit_final_button',[
                                                    'id'=>request()->item_id,
                                                    'route' => route('item-options.final-submit',request()->item_id) ,
                                                    'tooltip' => 'حذف',
                                                     ])
                        @endcomponent
                    </li>
                        @endif
                </ul>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
                    @foreach($options as $row)
                        <tr>
                            <td>{!! $loop->index +1 !!}</td>
                            <td>{!! optional($row->option)->name !!}</td>
                            <td>
                                @foreach($row->values as $value) - {{$value}}@endforeach
                            </td>
                            <td>
                                <nobr>
                                    @if($canNotMakeActions == 0)

                                    @component('partials.buttons._add_option_value_button',[
                                                    'route' => route('item-option-values.store') ,
                                                    'tooltip' => ' القيم',
                                                    'id' => $row->id
                                                     ])
                                    @endcomponent
                                    @component('partials.buttons._delete_button',[
                                                    'id'=>$row->id,
                                                    'route' => route('item-options.destroy',$row->id) ,
                                                    'tooltip' => 'حذف',
                                                     ])
                                    @endcomponent
                                        @endif
                                </nobr>
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>


            </div>
        </div><!-- /.card-body -->
    </div>






@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
