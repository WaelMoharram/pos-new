
<div class="form-group py-1 col-md-6">
    <label for="name"> {{__('الاسم')}}</label>
    {!! Form::text('name',request()->name ??null,['id'=>'name','class'=>'form-control col datetimepicker-input ','placeholder'=>__("الاسم")]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="barcode"> {{__('رقم الباركود')}}</label>
    {!! Form::text('barcode',request()->barcode ??null,['id'=>'barcode','class'=>'form-control col  ','placeholder'=>__("رقم الباركود")]) !!}
    {{input_error($errors,'barcode')}}
</div>
