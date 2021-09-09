<button data-toggle="modal" data-target="#modalAdd"
        class="nav-link active" title="اضافة" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>
    <i class="fa fa-lg fa-fw fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade text-left" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">اضافة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action=
                {{$route}}>
            <div class="modal-body">
                <input type="hidden" name="item_id" value="{{$id}}">
                {{ csrf_field() }}
                <div class="form-group py-1 col-md-12">
                    <label for="option_id"> الاختيارات المتاحة  </label>
                    {{Form::select('option_id',$forSelectOptions ,null,['class'=>'form-control mb-2','id'=>'option_id'])}}
                    {{input_error($errors,'option_id')}}
                </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">اضافة</button>


                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">تراجع</button>
            </div>
            </form>
        </div>
    </div>
</div>
