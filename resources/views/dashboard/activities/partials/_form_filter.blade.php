
<div class="form-group py-1 col-md-12">
    <label for="user_id"> {{__('User')}} </label>
    {{Form::select('user_id', \App\Models\User::all()->pluck('name','id') ,request()->user_id ?? null,['placeholder'=>__('All'),'class'=>'form-control mb-2','id'=>'category_id',disable_on_show()])}}
    {{input_error($errors,'user_id')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="from_date"> {{__('From date')}}</label>
    {!! Form::text('from_date',request()->from_date ??null,['id'=>'from_date','class'=>'form-control col datetimepicker-input date','placeholder'=>__("From date"),disable_on_show()]) !!}
    {{input_error($errors,'from_date')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="to_date"> {{__('To date')}}</label>
    {!! Form::text('to_date',request()->to_date ??null,['id'=>'to_date','class'=>'form-control col datetimepicker-input date','placeholder'=>__("To date"),disable_on_show()]) !!}
    {{input_error($errors,'to_date')}}
</div>
