{{-- ############# Date #############--}}
<div class="form-group py-1 col-md-6">
    <label for="date"> التاريخ  </label>
    <div class="input-group date" id="reservationdate" data-target-input="nearest">

        {{Form::text('date',null,['class'=>'form-control mb-2 datetimepicker-input','id'=>'date'])}}
        {{input_error($errors,'date')}}

    </div>
</div>
{{-- ############# Supplier #############--}}
<div class="form-group py-1 col-md-6">
    <label for="model_id"> المورد  </label>
    {{Form::select('model_id',\App\Models\Supplier::pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'model_id'])}}
    {{input_error($errors,'model_id')}}
</div>
{{-- ############# Store #############--}}
<div class="form-group py-1 col-md-6">
    <label for="store_id"> مخزن الصرف  </label>
    {{Form::select('store_id',\App\Models\Store::where('sales_man_id',null)->where('is_pos',1)->pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'store_id'])}}
    {{input_error($errors,'store_id')}}
</div>
{{-- ############# Bill Code #############--}}
<div class="form-group py-1 col-md-6">
    <label for="code"> رقم الفاتورة  </label>
    {{Form::text('code',null,['class'=>'form-control mb-2','id'=>'code'])}}
    {{input_error($errors,'code')}}
</div>
{{-- ############# Bill Notes #############--}}
<div class="form-group py-1 col-md-12">
    <label for="note"> ملاحظات على الفاتورة  </label>
    {{Form::textarea('note',null,['class'=>'form-control mb-2','id'=>'note','rows'=>'2'])}}
    {{input_error($errors,'note')}}
</div>