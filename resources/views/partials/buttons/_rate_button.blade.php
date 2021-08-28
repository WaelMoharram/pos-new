<button data-toggle="modal" data-target="#usersRate{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif  class="btn btn-md btn-warning" >

    <i class="fa fa-star"></i>
</button>

<!-- Modal -->
<div class="modal fade text-left" id="usersRate{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">{{__('Rate task')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action=
                {{$route}}>
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group py-1 col-md-12">
                <label for="client_id"> {{__('Rate')}} </label>
                {{Form::select('rate',[1=>1,2=>2,3=>3,4=>4,5=>5,] ,$rate??null,['class'=>'form-control mb-2','id'=>'client_id',disable_on_show()])}}
                {{input_error($errors,'rate')}}
            </div>
            </div>
            <div class="modal-footer">

                    <button type="submit" class="btn btn-danger">{!! __('Rate') !!}</button>


                <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
