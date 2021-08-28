@if(isset($category->image) && $category->image != null && $category->image !='')
    <div class="col-md-12">
<img src="{{url($category->image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@endif
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="formInputRole"> صورة </label>
    {!! Form::file('image',null,['class'=>'form-control col','placeholder'=>__("Image")]) !!}
    {{input_error($errors,'image')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> اسم التصنيف</label>
    {!! Form::text('name',null,['class'=>'form-control col','placeholder'=>'الاسم بالكامل',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>
