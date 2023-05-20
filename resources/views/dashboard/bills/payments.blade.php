@if($bill->payments()->count()>1)
    <tr>
        <td colspan="6">الدفعات</td>
    </tr>
    <tr>
        <td >#</td>

        <td colspan="3">التاريخ</td>
        <td colspan="2">المبلغ</td>
    </tr>
    @foreach($bill->payments as $payment)
        <tr>
            <td>{{$loop->index +1}}</td>
            {{--                                <td colspan="2">{{$payment->acceptUser->name}}</td>--}}
            <td colspan="3">{{$payment->date}}</td>

            <td colspan="2">{{$payment->money}}</td>
        </tr>
    @endforeach
@endif
