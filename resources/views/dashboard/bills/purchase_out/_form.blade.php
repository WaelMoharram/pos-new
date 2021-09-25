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
@if(auth()->user()->type == 'admin')
    {{-- ############# discount  #############--}}
    <div class="form-group py-1 col-md-6">
        <label for="discount">  الخصم ان وجد  </label>
        {{Form::text('discount',null,['class'=>'form-control mb-2','id'=>'discount'])}}
        {{input_error($errors,'discount')}}
    </div>

    {{-- ############# discount type #############--}}
    <div class="form-group py-1 col-md-6">
        <label for="discount_type"> اسم الخصم ان وجد  </label>
        {{Form::text('discount_type',null,['class'=>'form-control mb-2','id'=>'discount_type'])}}
        {{input_error($errors,'discount_type')}}
    </div>
@endif
{{-- ############# Bill Notes #############--}}
<div class="form-group py-1 col-md-12">
    <label for="note"> ملاحظات على الفاتورة  </label>
    {{Form::textarea('note',null,['class'=>'form-control mb-2','id'=>'note','rows'=>'2'])}}
    {{input_error($errors,'note')}}
</div>
