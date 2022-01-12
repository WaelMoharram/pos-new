<div class="col-md-12">
    <img id="logo" src="{!! $user->image ? url($user->image) : url('default_product.png') !!}" style="width: 100px;border-radius: 50px;">
</div>
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="logo_input"> صورة </label>
    {!! Form::file('image',['id'=>'logo_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadLogo(event)"]) !!}
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

<div class="form-group py-1 col-md-12">
    <label for="store_id"> ادارة مخزن   </label>
    {{Form::select('store_id',[\App\Models\Store::where('sales_man_id',null)->pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'store_id','placeholder'=>'الكل']])}}
    {{input_error($errors,'store_id')}}
</div>

<div class="form-group py-1 col-md-12 {{hidden_on_show()}}">
    <label for="formInputRole"> الدور </label>
    {{Form::select('role', $role, $user->roles->first()->id?? null, ['class'=>'form-control col select2',hidden_on_show(),] ) }}

</div>





