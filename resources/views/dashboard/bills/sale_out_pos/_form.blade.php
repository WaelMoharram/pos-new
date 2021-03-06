{{-- ############# Date #############--}}
<div class="form-group py-1 col-md-6">
    <label for="date"> التاريخ  </label>
    <div class="input-group date" id="reservationdate" data-target-input="nearest">

        {{Form::text('date',null,['class'=>'form-control mb-2 datetimepicker-input date','id'=>'date'])}}
        {{input_error($errors,'date')}}

    </div>
</div>
{{-- ############# Supplier #############--}}
<div class="form-group py-1 col-md-6">
    <label for="model_id"> العميل  </label>
    {{Form::select('model_id',\App\Models\Client::check()->pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'model_id'])}}
    {{input_error($errors,'model_id')}}
</div>
{{-- ############# Store #############--}}
@if(auth()->user()->store == null)
    <div class="form-group py-1 col-md-6">
        <label for="store_id"> مخزن الصرف  </label>
        {{Form::select('store_id',\App\Models\Store::where('sales_man_id',null)->where('is_pos',1)->pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'store_id'])}}
        {{input_error($errors,'store_id')}}
    </div>
@else
    <div class="form-group py-1 col-md-6">
        <label for="store_id"> مخزن الصرف  </label>
        {{Form::text('store_id',auth()->user()->store->name,['class'=>'form-control mb-2','id'=>'store_id','disabled'])}}
        <input type="hidden" name="store_id" value="{{auth()->user()->store->id}}">
    </div>
@endif
