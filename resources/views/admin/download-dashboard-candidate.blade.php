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
                <th>Nama Kandidat</th>
                <th>Verbal 1</th>
                <th>Verbal 2</th>
                <th>Verbal 3</th>
                <th>Verbal 4</th>
                <th>Numerical 1</th>
                <th>Numerical 2</th>
                <th>Numerical 3</th>
                <th>Numerical 4</th>
                <th>Abstrak 1</th>
                <th>Abstrak 2</th>
                <th>Abstrak 3</th>
                <th>Abstrak 4</th>
                <th>Skor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
                <td>{{ $data['verbal1'] }}</td>
                <td>{{ $data['verbal2'] }}</td>
                <td>{{ $data['verbal3'] }}</td>
                <td>{{ $data['verbal4'] }}</td>
                <td>{{ $data['numerical1'] }}</td>
                <td>{{ $data['numerical2'] }}</td>
                <td>{{ $data['numerical3'] }}</td>
                <td>{{ $data['numerical4'] }}</td>
                <td>{{ $data['abstrak1'] }}</td>
                <td>{{ $data['abstrak1'] }}</td>
                <td>{{ $data['abstrak2'] }}</td>
                <td>{{ $data['abstrak4'] }}</td>
                <td>{{ $data['skor'] }}</td>
                <td>{{ $data['status'] == "2" ? "PASS" : "FAIL" }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>