@extends('adminlte::page')

@section('title', 'عرض مندوب'.$user->name)

@section('content_header')
    <h1>عرض العهدة المالية لـ {{$user->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">    <h1> العهدة الحالية : {{$user->for_collect}}</h1>
        </div>
        @can('is_admin')
            <div class="col-md-6">@if($user->for_collect != 0)

                <a href="{{route('sales-men.collect',$user->id)}}" style="width: 100%" class="btn btn-primary pull-right"> استلام </a>
                                      @endif
            </div>
        @endcan
    </div>
    {{-- Setup data for datatables --}}
    @php
        $heads = [
            '#',
            'الفاتورة',
            ['label' => 'المبلغ'],
            ['label' => 'نوع العملية'],
            ['label' => 'تم التوريد'],
        ];


        $config = [
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable with-buttons>
        @foreach($payments as $row)
            <tr>
                <td>{!! substr(str_repeat(0, 5).($loop->index +1), - 5); !!}</td>
                <td>#{!! optional($row->bill)->code !!}</td>

                <td>{!! $row->money !!}</td>
                <td>{!! $row->type_name !!}</td>
                <td>{!! $row->money_collected ? 'نعم': 'لا' !!}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>





@stop

@section('css')
@stop

@section('js')

    @include('sweetalert::alert')
@stop
