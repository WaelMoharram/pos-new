
<input type="hidden" name="item_id" value="{{$unit->item_id ?? request()->item_id}}">
<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> اسم الوحدة</label>
    {!! Form::text('name',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>


<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> معامل التحويل - كم العدد فى الوحدة الأساسية </label>
    {!! Form::number('ratio',null,['class'=>'form-control col','step'=>'any',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'ratio')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> سعر بيع الوحدة </label>
    {!! Form::number('price',null,['class'=>'form-control col','step'=>'any',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'price')}}
</div>
