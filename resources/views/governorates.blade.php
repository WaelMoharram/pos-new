<table>
    <thead>
    <tr>
        <th>Governorate ID</th>
        <th>Governorate name AR</th>
        <th>Governorate name EN</th>
        <th>City ID</th>
        <th>City name AR</th>
        <th>City name EN</th>
    </tr>
    </thead>
    <tbody>
    @foreach($governorates as $governorate)
        <tr>
            <td>{{ $governorate->id }}</td>
            <td>{{ $governorate->governorate_name_ar }}</td>
            <td>{{ $governorate->governorate_name_en }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($governorate->cities as $city)
            <tr>
                <td>{{ $governorate->id }}</td>
                <td>{{ $governorate->governorate_name_ar }}</td>
                <td>{{ $governorate->governorate_name_en }}</td>
                <td>{{ $city->id }}</td>
                <td>{{ $city->city_name_ar }}</td>
                <td>{{ $city->city_name_en }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
