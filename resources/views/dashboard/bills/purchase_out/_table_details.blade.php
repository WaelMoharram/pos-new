<div class=" col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أصناف الفاتورة</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table " dir="rtl">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>الصنف</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>الاجمالى</th>
                    <th style="width: 40px">اعدادات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($details as $detail)
                    <tr>
                        <td>{{$substr(str_repeat(0, 5).($loop->index +1), - 5);}}</td>
                        <td>{{optional($detail->item)->name_w_category}}</td>
                        <td>
                            {{$detail->amount}}
                        </td>
                        <td>
                            {{$detail->price}}
                        </td>

                        <td>
                            {{$detail->total}}
                        </td>
                        <td><span class="">
                                @component('partials.buttons._delete_button',[
                                    'id'=>$detail->id,
                                    'route' => route('bill-details.destroy',$detail->id) ,
                                    'tooltip' => 'حذف',
                                ])
                                @endcomponent
                            </span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
