@if($bill->remaining == 0)
<button type="submit" class="col-md-12 btn btn-primary mr-1 mb-1 waves-effect waves-light">حفظ الفاتورة</button>
@else
    <div class="row">

        <button type="submit" class="col-md-6 btn btn-primary mb-1 waves-effect waves-light">حفظ الفاتورة</button>
        <button type="button" class="col-md-6 btn btn-success mb-1 waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">
            حفظ وسداد
        </button>
        <!-- Modal -->

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">سداد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group  col-md-12">
                    <label for="date"> التاريخ  </label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">

                        {{Form::text('money_date',null,['class'=>'form-control mb-2 datetimepicker-input date'])}}
                        {{input_error($errors,'money_date')}}

                    </div>
                </div>
                <div class="form-group  col-md-12">
                    <label for="money"> المبلغ  </label>
                    {{Form::text('money',null,['class'=>'form-control mb-2','id'=>'money'])}}
                    {{input_error($errors,'money')}}
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                    <button type="submit" name="pay" value="1" class="btn btn-primary">سداد</button>
                </div>
            </div>
        </div>
    </div>

@endif
