<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Download Result</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Universitas</th>
                <th>Major</th>
                <th>Job Position</th>
                <th>Job Type</th>
                <th>Set Test</th>
                <th>Start LatLong</th>
                <th>End Latlong</th>
                <th>Time Start</th>
                <th>Time End</th>
                <th>Verbal Skor</th>
                <th>Numerik Skor</th>
                <th>Abstrak Skor</th>
                <th>Final Skor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->universitas }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->job_position }}</td>
                <td>{{ $data->type == "1" ? "Full Time" : "Intership" }}</td>
                <td>{{ $data->set_test }}</td>
                <td>{{ $data->location_start_radius }}</td>
                <td>{{ $data->location_end_radius }}</td>
                <td>{{ $data->start_time_participant }}</td>
                <td>{{ $data->end_time_participant }}</td>
                <td>{{ $data->verbal_skor }}</td>
                <td>{{ $data->numerical_skor }}</td>
                <td>{{ $data->abstrak_skor }}</td>
                <td>{{ $data->skor }}</td>
                @if ($data->status == "3") 
                    <td>PASS</td>
                @elseif($data->status == "4")
                    <td>FAIL</td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>