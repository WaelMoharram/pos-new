@if(isset($option->image) && $option->image != null && $option->image !='')
    <div class="col-md-12">
<img src="{{url($option->image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@endif
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="formInputRole"> صورة </label>
    {!! Form::file('image',null,['class'=>'form-control col','placeholder'=>__("Image")]) !!}
    {{input_error($errors,'image')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> الاسم </label>
    {!! Form::text('name',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>
<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> ملاحظات</label>
    {!! Form::textarea('note',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'note')}}
</div>
