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
        {{Form::select('store_id',\App\Models\Store::pluck('name','id') ,null,['disabled','class'=>'form-control mb-2','id'=>'store_id'])}}
        {{input_error($errors,'store_id')}}
    </div>
@else
    <div class="form-group py-1 col-md-6">
        <label for="store_id"> مخزن الصرف  </label>
        {{Form::text('store_id',auth()->user()->store->name,['class'=>'form-control mb-2','id'=>'store_id','disabled'])}}
        <input type="hidden" name="store_id" value="{{auth()->user()->store->id}}">
    </div>
@endif
{{-- ############# Need discount #############--}}
<div class="form-group py-1 col-md-6">
    <label for="need_discount"> طلب خصم على الفاتورة  </label>
    {{Form::select('need_discount',[0=>'لا' , 1=>'نعم'] ,null,['class'=>'form-control mb-2','id'=>'need_discount'])}}
    {{input_error($errors,'need_discount')}}
</div>
{{--@if(auth()->user()->type == 'admin')--}}
    @can('discount sales')
        <div class="form-group py-1 col-md-4">
            <label for="discount_kind"> نوع الخصم  </label>
            {{Form::select('discount_kind',[null=>'لا يوجد','fixed'=>'مبلغ ثابت' , 'percent'=>'نسبة'] ,null,['class'=>'form-control mb-2','id'=>'discount_kind'])}}
            {{input_error($errors,'discount_kind')}}
        </div>
        {{-- ############# discount  #############--}}
        <div class="form-group py-1 col-md-4">
            <label for="discount_percent">  الخصم ان وجد  </label>
            {{Form::number('discount_percent',null,['class'=>'form-control mb-2','id'=>'discount_percent'])}}
            {{input_error($errors,'discount_percent')}}
        </div>


{{-- ############# discount type #############--}}
<div class="form-group py-1 col-md-4">
    <label for="discount_type"> اسم الخصم ان وجد  </label>
    {{Form::text('discount_type',null,['class'=>'form-control mb-2','id'=>'discount_type'])}}
    {{input_error($errors,'discount_type')}}
</div>
        @endcan
{{--@endif--}}
{{-- ############# Bill Notes #############--}}
<div class="form-group py-1 col-md-12">
    <label for="note"> ملاحظات على الفاتورة  </label>
    {{Form::textarea('note',null,['class'=>'form-control mb-2','id'=>'note','rows'=>'2'])}}
    {{input_error($errors,'note')}}
</div>
