<div class="col-md-12">
    <img id="logo" src="{!! $category->image ? url($category->image) : url('default_product.png') !!}" style="width: 100px;border-radius: 50px;">
</div>
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="logo_input"> صورة </label>
    {!! Form::file('image',['id'=>'logo_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadLogo(event)"]) !!}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> اسم التصنيف</label>
    {!! Form::text('name',null,['class'=>'form-control col','placeholder'=>'الاسم بالكامل',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="upper_id"> التصنيف الاعلى   </label>
    {{Form::select('upper_id',\App\Models\Category::pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'upper_id','placeholder'=>'لا يوجد'])}}
    {{input_error($errors,'upper_id')}}
</div>
