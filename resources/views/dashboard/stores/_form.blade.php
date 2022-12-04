
<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> اسم المخزن</label>
    {!! Form::text('name',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="address"> العنوان </label>
    {!! Form::textarea('address',null,['id'=>'address','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'address')}}
</div>

{{--<div class="form-group py-1 col-md-12">--}}
{{--    <label for="is_pos"> امكانية البيع المباشر  </label>--}}
{{--    {{Form::select('is_pos',[true=>'نعم',false=>'لا'] ,null,['class'=>'form-control mb-2','id'=>'is_pos'])}}--}}
{{--    {{input_error($errors,'is_pos')}}--}}
{{--</div>--}}






