<a data-toggle="modal" data-target="#modalAdd" class="btn btn-lg btn-default text-info mx-1 shadow"  data-placement="top" title="{{$tooltip}}">
    <i class="fa fa-lg fa-fw fa-plus-square"></i>{{$tooltip}}
</a>
<style>
    .modal-body{
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
</style>
<!-- Modal -->
<div class="modal fade text-left" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">اضافة فاتورة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action=
                {{$route}}>
                <div class="modal-body">
                    <div class="row">
                        {{ csrf_field() }}
{{--                        <input type="hidden" name="type" value="{{$type}}">--}}
                        {{-- ############# Date #############--}}
                        <div class="form-group py-1 col-md-12">
                            <label for="date"> التاريخ  </label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">

                                {{Form::text('date',null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'date'])}}
                                {{input_error($errors,'date')}}

                            </div>
                        </div>
                        {{-- ############# Supplier #############--}}
                        <div class="form-group py-1 col-md-12">
                            <label for="model_id"> العميل  </label>
                            {{Form::select('model_id',\App\Models\Client::pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'model_id'])}}
                            {{input_error($errors,'model_id')}}
                        </div>
                        {{-- ############# Store #############--}}
                        <div class="form-group py-1 col-md-12">
                            <label for="store_id"> مخزن الصرف  </label>
                            {{Form::select('store_id',\App\Models\Store::where('sales_man_id',null)->where('is_pos',1)->pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'store_id'])}}
                            {{input_error($errors,'store_id')}}
                        </div>

                        {{-- ############# Bill Notes #############--}}
                        <div class="form-group py-1 col-md-12">
                            <label for="note"> ملاحظات على الفاتورة  </label>
                            {{Form::text('note',null,['class'=>'form-control mb-2','id'=>'note','rows'=>2])}}
                            {{input_error($errors,'note')}}
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">اضافة</button>

                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">تراجع</button>
                </div>
            </form>
        </div>
    </div>
</div>

