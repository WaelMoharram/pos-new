<button data-toggle="modal" data-target="#modalBarcode{{$id}}" class="btn btn-xs btn-default text-danger mx-1 shadow" title="طباعة باركود" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>
    <i class="fa fa-lg fa-fw fa-trash"></i>
</button>
{{--<button data-toggle="modal" data-target="#usersBarcode{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif  class="btn btn-md btn-danger" >--}}

{{--    <i class="fa fa-trash-o"></i>--}}
{{--</button>--}}

<!-- Modal -->
<div class="modal fade text-left" id="modalBarcode{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">حذف</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action=
                {{$route}}>
            <div class="modal-body">
                <h5>برجاء كتابه عدد الباركود</h5>
            </div>
            <div class="modal-footer">
                <div class="form-group py-1 col-md-12">
                    <input type="item_id" value="{{$id}}">
                    <label for="quantity"> العدد  </label>
                    {{Form::number('quantity',null,['class'=>'form-control mb-2','id'=>'quantity'])}}
                    {{input_error($errors,'quantity')}}
                </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">طباعة</button>


                <button type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
            </div>
            </form>
        </div>
    </div>
</div>
