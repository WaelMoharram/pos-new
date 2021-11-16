<input type="hidden" name="bill_id" value="{{$bill->id}}">

{{-- ############# Supplier #############--}}
<div class="form-group col-md-12">
    <label for="sub_item_id"> اختر الصنف </label>
    {{Form::select('sub_item_id',\App\Models\SubItem::get()->pluck('name','id') ,null,['class'=>'form-control mb-2 select2','id'=>'sub_item_id '])}}
    {{input_error($errors,'sub_item_id')}}
</div>
{{-- ############# Bill Code #############--}}
<div class="form-group  col-md-12">
    <label for="amount"> الكمية  </label>
    {{Form::text('amount',null,['class'=>'form-control mb-2','id'=>'amount'])}}
    {{input_error($errors,'amount')}}
</div>
@can('discount sales')
    <div class="form-group  col-md-12">
        <label for="discount"> الخصم ان وجد  </label>
        {{Form::text('discount',0,['class'=>'form-control mb-2','id'=>'amount'])}}
        {{input_error($errors,'amount')}}
    </div>
@endcan
<div class="form-group col-md-12">
<button type="submit" class="col-md-12 btn btn-primary mr-1 mb-1 waves-effect waves-light">اضافة</button>
</div>



