<a data-toggle="modal" data-target="#modalAdd{{$id}}" class="btn btn-xs btn-default text-orange mx-1 shadow"  data-placement="top" title="{{$tooltip}}">
    <i class="fa fa-lg fa-fw fa-plus-square"></i>
</a>

<!-- Modal -->
<div class="modal fade text-left" id="modalAdd{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                    <input type="hidden" name="item_option_id" value="{{$id}}">
                    {{ csrf_field() }}
                    <div class="form-group py-1 col-md-12">
                        <label for="value"> اسم القيمة  </label>
                        {{Form::text('value',null,['class'=>'form-control mb-2','id'=>'value'])}}
                        {{input_error($errors,'value')}}
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
