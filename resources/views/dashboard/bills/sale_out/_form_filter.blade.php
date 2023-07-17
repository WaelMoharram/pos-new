<div class="form-group py-1 col-md-6">
    <label for="store_id"> المخزن </label>
    {{Form::select('store_id',\App\Models\Store::pluck('name','id') ,request()->store_id ?? null,['class'=>'form-control mb-2','id'=>'store_id','placeholder'=>'اختر المخزن'])}}
    {{input_error($errors,'store_id')}}
</div>
<div class="form-group py-1 col-md-6">
    <label for="date"> التاريخ  </label>
    <div class="input-group date" id="reservationdate" data-target-input="nearest">

        {{Form::text('date',request()->date ?? null,['class'=>'form-control mb-2 datetimepicker-input ','id'=>'date'])}}
        {{input_error($errors,'date')}}

    </div>
</div>

<div class="form-group py-1 col-md-6">
    <label for="model_id"> العميل  </label>
    {{Form::select('model_id',\App\Models\Client::check()->pluck('name','id') ,request()->model_id ??null,['class'=>'form-control mb-2','id'=>'model_id'])}}
    {{input_error($errors,'model_id')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="code"> رقم القاتورة  </label>
    <div class="input-group " >

        {{Form::text('code',request()->code ?? null,['class'=>'form-control mb-2 ','id'=>'code'])}}
        {{input_error($errors,'code')}}

    </div>
</div>
<input type="hidden" name="type" value="{{request()->type}}">
