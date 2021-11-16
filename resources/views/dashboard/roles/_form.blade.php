
<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> الاسم بالكامل</label>
    {!! Form::text('name',null,['class'=>'form-control col','placeholder'=>'الاسم بالكامل',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="name"> الاسم </label>
    {!! Form::text('name',null,['id'=>'name','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>
<div class="clearfix"></div>
<h3> صلاحيات </h3>
<br>
<div class="clearfix"></div>


@foreach(\App\Models\User::GROUPS as $group)
<div class="form-group py-1 col-md-4 {{hidden_on_show()}}">
    <label for="formInputRole"> {{__($group)}} </label>
    {{Form::select('permissions[]', \Spatie\Permission\Models\Permission::where('group',$group)->pluck('name', 'id'), (isset($role->permissions)? $role->permissions: null), ['class'=>'form-control col select2',hidden_on_show(),  'multiple'] ) }}

</div>
@endforeach




