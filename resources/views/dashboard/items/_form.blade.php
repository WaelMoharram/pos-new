@if(isset($item->image) && $item->image != null && $item->image !='')
    <div class="col-md-12">
<img src="{{url($item->image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@endif
<div class="form-group col-md-12 {{hidden_on_show()}}">
    <label for="formInputRole"> صورة </label>
    {!! Form::file('image',null,['class'=>'form-control col','placeholder'=>__("Image")]) !!}
    {{input_error($errors,'image')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> اسم الصنف</label>
    {!! Form::text('name',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="category_id"> التصنيف  </label>
    {{Form::select('category_id',\App\Models\Category::pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'category_id'])}}
    {{input_error($errors,'category_id')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="brand_id"> العلامة التجارية  </label>
    {{Form::select('brand_id',\App\Models\Brand::pluck('name','id') ,null,['class'=>'form-control mb-2','id'=>'brand_id'])}}
    {{input_error($errors,'brand_id')}}
</div>
<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> كود الصنف</label>
    {!! Form::text('code',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'code')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> رقم الباركود</label>
    {!! Form::text('barcode',null,['class'=>'form-control col',isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'barcode')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="has_options"> يحتوى على اختيارات  </label>
    {{Form::select('has_options',[true=>'نعم',false=>'لا'] ,null,['class'=>'form-control mb-2','id'=>'has_options'])}}
    {{input_error($errors,'has_options')}}
</div>
