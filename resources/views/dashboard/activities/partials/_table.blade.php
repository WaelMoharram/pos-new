<table class="table table-striped ">
    <thead>
    <tr>
        <th scope="col">التاريخ</th>
        <th scope="col">المستخدم</th>
        <th scope="col">الاجراء</th>
{{--        <th scope="col">القسم</th>--}}
{{--        <th scope="col">اسم العنصر</th>--}}
        <th scope="col">التفاصيل</th>
    </thead>
    <tbody>
    @foreach($activities as $activity)
        @include('dashboard.activities.partials._table_raw')
    @endforeach
    </tbody>

</table>

{{$activities->appends(request()->except('page'))->links()}}
