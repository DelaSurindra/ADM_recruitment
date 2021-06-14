<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Kandidat</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('d/m/Y', strtotime($data['created_at'])) }}</td>
                <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
                <td>{{ $data['email'] }}</td>
                <td>{{ date('d/m/Y', strtotime($data['tanggal_lahir'])) }}</td>
                <td>{{ $data['gender'] == "1" ? "Male" : "Female" }}</td>
                <td>{{ $data['telp'] }}</td>
                <td>{{ $data['kota'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>