@extends('adminlte::page')

@section('title', 'تعديل فاتورة')

@section('content_header')
    <h1>تعديل فاتورة بيع رقم {{$bill->code}}</h1>
@stop

@section('content')

    {{-- ########## Main section ########## --}}
    <div class="card col-md-12 collapsed-card">
        <div class="card-header">
            <h3 class="card-title">{{$bill->code}} - {{optional($bill->model)->name}} - {{optional($bill->store)->name}} - {{$bill->total}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">

            {!! Form::model($bill,['method'=>'put','route'=>['bills.update',$bill->id],'class'=>'form','enctype' => 'multipart/form-data']  ) !!}
            @csrf()
            <div class="row">
                @include('dashboard.bills.sale_out._form')
                @component('partials.buttons._save_button',[])
                @endcomponent
            </div>
            {!! Form::close() !!}
        </div>
    </div>

<div class="row ">
    {{-- ########## Bill details table  ########## --}}

    @include('dashboard.bills.sale_out._table_details')
<div class="col-md-4 ">
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">اضافة صنف للفاتورة</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            {{-- ########## Add item Form  ########## --}}
            <div class="form-group  col-md-12">
                <label for="barcode"> باركود  </label>
                {{Form::text('barcode',null,['class'=>'form-control mb-2','id'=>'barcode'])}}
                {{input_error($errors,'barcode')}}
            </div>

                {!! Form::open(['method'=>'post','route'=>'bill-details.store','class'=>' col-md-12','dir'=>'']) !!}
                    @csrf()
                    <div class="row">
                        @include('dashboard.bills.sale_out._form_details')
                    </div>
                {!! Form::close() !!}
        </div>
    </div>


    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">اجمالى الفاتورة</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table" dir="rtl">
                    <tbody>
                    @if($bill->tax != null || $bill->tax != 0 || $bill->discount != null || $bill->discount != 0)
                    <tr>
                        <th style="width:50%">اجمالى الأصناف</th>
                        <td>{{$details->sum('total')}}</td>
                    </tr>
                    @endif
                    @if($bill->tax != null || $bill->tax != 0)
                    <tr>
                        <th>{{$bill->tax_type ?? 0}}</th>
                        <td>{{$bill->tax ?? 0}}</td>
                    </tr>
                    @endif
                    @if($bill->discount != null || $bill->discount != 0)
                    <tr>
                        <th>{{$bill->discount_type ?? 0}}</th>
                        <td>{{$bill->discount ?? 0}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>الاجمالى</th>
                        <td>{{$bill->total}}</td>
                    </tr>
                    </tbody></table>
            </div>
        </div>
    </div>


</div>
    {!! Form::open(['method'=>'post','route'=>['bills.save',$bill->id],'class'=>' col-md-12','dir'=>'']) !!}
    @component('partials.buttons._save_bill_button',['bill'=>$bill])@endcomponent


    {!! Form::close() !!}
</div>
@stop
@section('plugins.Select2', true)
@section('css')
@stop

@section('js')
    <script>
        $('.select2').select2({
           dir:'rtl',
        });
    </script>
    <script>
        $('#barcode').change(function(){
            $.ajax({
                url: "{{route('barcode')}}",
                data: { "barcode": $("#barcode").val() },
                type: "get",
                success: function(data){
                    //console.log(data);
                    if (data != null){
                        $("#item_id").val(parseInt(data.id));
                        $("#item_id").trigger('change');
                        $("#unit_id option").remove();

                        console.log('test1'+data.units);
                        $.each( data.units, function(k, v) {
                            console.log('name'+v.name);
                            console.log('for'+v.for);
                            console.log('id'+v.id);
                            if(v.for === 'sales_man'){

                                $('#unit_id').append('<option selected value="'+v.id+'">'+v.name+'</option>');
                            }else{

                                $('#unit_id').append('<option value="'+v.id+'">'+v.name+'</option>');
                            }
                        });

                    }
                }
            });
        });

        $('#item_id').change(function(){
            $.ajax({
                url: "{{route('units-for-item')}}",
                data: { "id": $("#item_id").val() },
                type: "get",
                success: function(data){
                    if (data != null){
                        // $("#item_id").val(parseInt(data.id));
                        // $("#item_id").trigger('change');
                        $("#unit_id option").remove();
                        console.log('test1'+data.units);
                        $.each( data.units, function(k, v) {
                            console.log('name'+v.name);
                            console.log('for'+v.for);
                            console.log('id'+v.id);
                            if(v.for === 'sales_man'){

                                $('#unit_id').append('<option selected value="'+v.id+'">'+v.name+'</option>');
                            }else{

                                $('#unit_id').append('<option value="'+v.id+'">'+v.name+'</option>');
                            }
                        });

                    }
                }
            });
        });

    </script>
    @include('sweetalert::alert')
@stop
