<input type="hidden" name="bill_id" value="{{$bill->id}}">
{{-- ############# Supplier #############--}}
<div class="form-group col-md-12">
    <label for="item_id"> اختر الصنف </label>
    {{Form::select('item_id',\App\Models\Item::get()->pluck('name_w_category','id') ,null,['class'=>'form-control mb-2 select2','id'=>'item_id'])}}
    {{input_error($errors,'item_id')}}
</div>
{{-- ############# Bill Code #############--}}
<div class="form-group  col-md-12">
    <label for="amount"> الكمية  </label>
    {{Form::text('amount',null,['class'=>'form-control mb-2','id'=>'amount','required'])}}
    {{input_error($errors,'amount')}}
</div>
<div class="form-group col-md-12">
    <label for="unit_id"> اختر الوحدة </label>
    {{Form::select('unit_id',[] ,null,['class'=>'form-control mb-2','id'=>'unit_id'])}}
    {{input_error($errors,'unit_id')}}
</div>
<div class="form-group col-md-12">
<button type="submit" class="col-md-12 btn btn-primary mr-1 mb-1 waves-effect waves-light">اضافة</button>
</div>



