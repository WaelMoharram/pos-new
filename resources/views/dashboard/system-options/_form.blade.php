<input type="hidden" name="key" value="{{$option->key}}">

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> القيمة </label>
    {!! Form::text('value',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'value')}}
</div>
