<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Job</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Submit Date</th>
                <th>Name</th>
                <th>Age</th>
                <th>Graduate</th>
                <th>University</th>
                <th>Faculty</th>
                <th>Major</th>
                <th>GPA</th>
                <th>Graduate Year</th>
                <th>Job Position</th>
                <th>Area</th>
                <th>Application Status</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->submit_date }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->age }}</td>
                <td>{{ $data->gelar_text }}</td>
                <td>{{ $data->universitas }}</td>
                <td>{{ $data->fakultas }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->gpa }}</td>
                <td>{{ $data->graduate_year }}</td>
                <td>{{ $data->job_position }}</td>
                <td>{{ $data->area }}</td>
                <td>{{ $data->status_text }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>