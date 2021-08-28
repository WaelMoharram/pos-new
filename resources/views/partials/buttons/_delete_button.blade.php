<button data-toggle="modal" data-target="#usersDelete{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif  class="btn btn-md btn-danger" >

    <i class="fa fa-trash-o"></i>
</button>

<!-- Modal -->
<div class="modal fade text-left" id="usersDelete{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">{{__('Delete User')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>{{__('Are you sure you want to delete record ?')}}</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" action=
                    {{$route}}>
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">{!! __('Delete') !!}</button>

                </form>
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
