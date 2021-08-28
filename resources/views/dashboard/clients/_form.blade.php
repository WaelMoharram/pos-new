
<div class="form-group py-1 col-md-12">
    <label for="name"> اسم العميل</label>
    {!! Form::text('name',null,['id'=>'name','class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="phone"> الهاتف</label>
    {!! Form::text('phone',null,['id'=>'phone','class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'phone')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="email"> email</label>
    {!! Form::email('email',null,['id'=>'email','class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'email')}}
</div>


<div class="form-group py-1 col-md-6">
    <label for="address"> العنوان </label>
    {!! Form::textarea('address',null,['id'=>'address','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'address')}}
</div>
<div class="form-group py-1 col-md-6">
    <label for="notes"> ملاحظات عن العميل </label>
    {!! Form::textarea('notes',null,['id'=>'notes','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'notes')}}
</div>







