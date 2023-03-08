<table>
    <thead>
    <tr>
        <th>رقم الصنف</th>
        <th>رقم الوحدة</th>
        <th>اسم الصنف</th>
        <th>اسم الوحدة</th>
        <th>السعر</th>
    </tr>
    </thead>
    <tbody>
    @foreach($units as $unit)
        <tr>
            <td>{{ optional($unit->item)->id }}</td>
            <td>{{ $unit->id }}</td>
            <td>{{ optional($unit->item)->name }}</td>
            <td>{{ $unit->name }}</td>
            <td>{{ $unit->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
