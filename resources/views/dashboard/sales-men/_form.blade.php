@if(isset($user->image) && $user->image != null && $user->image !='')
    <div class="col-md-12">
<img src="{{url($user->image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@endif
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="formInputRole"> صورة </label>
    {!! Form::file('image',null,['class'=>'form-control col','placeholder'=>__("Image")]) !!}
    {{input_error($errors,'image')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> الاسم بالكامل</label>
    {!! Form::text('name',null,['class'=>'form-control col','placeholder'=>'الاسم بالكامل',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="username"> اسم المستخدم </label>
    {!! Form::text('username',null,['id'=>'username','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'username')}}
</div>
<div class="form-group py-1 col-md-6">
    <label for="email"> البريد الالكترونى </label>
    {!! Form::email('email',null,['id'=>'email','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'email')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="mobile"> الهاتف </label>
    {!! Form::text('mobile',null,['id'=>'mobile','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'mobile')}}
</div>
<div class="form-group py-1 col-md-6 {{hidden_on_show()}}">
    <label for="formInputRole"> كلمة المرور </label>
    {!! Form::password('password',['class'=>'form-control col',]) !!}
    {{input_error($errors,'password')}}
</div>

<div class="form-group py-1 col-md-6 {{hidden_on_show()}}">
    <label for="formInputRole"> تأكيد كلمة المرور </label>
    {!! Form::password('password_confirmation',['class'=>'form-control col',hidden_on_show()]) !!}
    {{input_error($errors,'password_confirmation')}}
</div>






