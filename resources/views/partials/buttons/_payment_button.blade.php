<button data-toggle="modal" data-target="#modalPayment{{$id}}" class="btn btn-xs btn-default text-success mx-1 shadow" title="دفغ" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif>

    <i class="fa fa-lg fa-fw fa-money-bill"></i>
    @if(isset($tooltip) && $type == 'collect') {{$tooltip}} @endif
</button>
{{--<button data-toggle="modal" data-target="#usersPayment{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif  class="btn btn-md btn-danger" >--}}

{{--    <i class="fa fa-trash-o"></i>--}}
{{--</button>--}}

<!-- Modal -->
<div class="modal fade text-left" id="modalPayment{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">دفع</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="forma{{$id}}"  method="POST" action=
                {{$route}}>
            <div class="modal-body">
                <div class="row">
                    {{ csrf_field() }}
                    @if($type != 'collect')
                    <input type="hidden" name="bill_id" value="{{$id}}">
                    @else
                        <input type="hidden" name="sales_man_id" value="{{$id}}">

                    @endif
                    <input type="hidden" name="type" value="{{$type}}">
                    {{-- ############# Date #############--}}
                    <div class="form-group py-1 col-md-12">
                        <label for="date"> التاريخ  </label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">

                            {{Form::text('date',null,['class'=>'form-control mb-2 datetimepicker-input date'])}}
                            {{input_error($errors,'date')}}

                        </div>
                    </div>
                    {{-- ############# Bill Code #############--}}
                    <div class="form-group py-1 col-md-12">
                        <label for="money"> المبلغ  </label>
                        {{Form::number('money',null,['step'=>'any','class'=>'form-control mb-2','id'=>'money'.$id,'required'])}}
                        {{input_error($errors,'money')}}
                    </div>

                </div>
            </div>

                <div class="modal-footer">
                    <button  id="submitBtn{{$id}}"  type="submit" class="submit btn btn-primary">دفع</button>

                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">تراجع</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('js')
    @include('sweetalert::alert')

    <script>
{{--    $(document).ready(function () {--}}

{{--        $("#form{{$id}}").submit(function (e) {--}}
{{--alert('wqef');--}}
{{--            //stop submitting the form to see the disabled button effect--}}
{{--            e.preventDefault();--}}

{{--            //disable the submit button--}}
{{--            $("#submit").attr("disabled", true);--}}

{{--            //disable a normal button--}}
{{--            // $("#btnTest").attr("disabled", true);--}}

{{--            return true;--}}

{{--        });--}}
{{--    });--}}

$(document).ready(function() {

        $("#submitBtn{{$id}}").click(function () {
            var inputValue = $("#money{{$id}}").val();

            if (inputValue !== "") {
                alert('in')
                $(this).prop("disabled", true);
                $(this).addClass("disabled");
                $(this).html("جارى الدفع ...");
                $("#forma{{$id}}").unbind('submit').submit();
            }
        });

});
</script>
@endsection
