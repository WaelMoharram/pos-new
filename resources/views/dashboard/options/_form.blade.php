<div class="col-md-12">
    <img id="logo" src="{!! $option->image ? url($option->image) : url('default_product.png') !!}" style="width: 100px;border-radius: 50px;">
</div>
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="logo_input"> صورة </label>
    {!! Form::file('image',['id'=>'logo_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadLogo(event)"]) !!}
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
