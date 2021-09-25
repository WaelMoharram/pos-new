<button data-toggle="modal" data-target="#modalSubmit{{$id}}" class="nav-link active" title="حذف" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>
    <i class="fa fa-lg fa-fw fa-check"></i>
</button>
{{--<button data-toggle="modal" data-target="#usersSubmit{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif  class="btn btn-md btn-success" >--}}

{{--    <i class="fa fa-trash-o"></i>--}}
{{--</button>--}}

<!-- Modal -->
<div class="modal fade text-left" id="modalSubmit{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">حذف</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>هل انت متأكد من اعتماد هذه الاختيارات ؟</h5>
                <h5>لا يمكن التراجع</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" action=
                    {{$route}}>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">اعتماد</button>

                </form>
                <button type="button" class="btn btn-primary" data-dismiss="modal">تراجع</button>
            </div>
        </div>
    </div>
</div>
