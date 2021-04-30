<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Dashboard</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama {{$type == "1" ? "Universitas" : "Major"}}</th>
                <th>Total User</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $type =="1" ? $data['universitas'] : $data['jurusan'] }}</td>
                <td>{{ $data['total'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>