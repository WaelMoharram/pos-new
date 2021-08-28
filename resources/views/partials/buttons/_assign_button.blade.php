<button data-toggle="modal" data-target="#usersAssign{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif  class="btn btn-md btn-warning" >

    <i class="fa fa-star"></i>
</button>
<!-- Modal -->
<div class="modal fade text-left" id="usersAssign{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">{{__('Select employee')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" action=
                {{$route}}>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$id}}">
            <div class="modal-body">
                <div class="form-group py-1 col-md-12">
                <label for="user_id"> {{__('Assign')}} </label>
                {{Form::select('user_id',\App\User::pluck('name','id') ,$user_id??null,['class'=>'form-control mb-2','id'=>'user_id',disable_on_show()])}}
                {{input_error($errors,'user_id')}}
            </div>
            </div>
            <div class="modal-footer">

                    <button type="submit" class="btn btn-danger">{!! __('Assign') !!}</button>


                <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
