{{--@if(isset($user->image))--}}
{{--    <div class="col-md-12">--}}
{{--<img src="{{url($user->image)}}" style="width: 100px;border-radius: 50px;">--}}
{{--    </div>--}}
{{--@endif--}}
{{--<div class="form-group col-md-12 {{hidden_on_show()}}">--}}
{{--    <label for="formInputRole"> {{__('Image')}}</label>--}}
{{--    {!! Form::file('image',null,['class'=>'form-control col','placeholder'=>__("Image")]) !!}--}}
{{--    {{input_error($errors,'image')}}--}}
{{--</div>--}}

<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> {{__('Full name')}}</label>
    {!! Form::text('name',null,['class'=>'form-control col','placeholder'=>__("Full name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> {{__('Username')}} </label>
    {!! Form::email('username',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'username')}}
</div>
<div class="form-group py-1 col-md-6 {{hidden_on_show()}}">
    <label for="formInputRole"> {{__('Password')}} </label>
    {!! Form::password('password',['class'=>'form-control col',]) !!}
    {{input_error($errors,'password')}}
</div>

<div class="form-group py-1 col-md-6 {{hidden_on_show()}}">
    <label for="formInputRole"> {{__('Confirm password')}} </label>
    {!! Form::password('password_confirmation',['class'=>'form-control col',hidden_on_show()]) !!}
    {{input_error($errors,'password_confirmation')}}
</div>






