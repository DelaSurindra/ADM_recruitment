<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Report</title>
</head>
<body>
    @if($tipe == "1")
    <table class="table-report">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Test ID</th>
                <th rowspan="2">Kota</th>
                <th rowspan="2">Total Peserta Test</th>
                <th colspan="3">Nilai Rata Rata</th>
                <th rowspan="2">Peserta Lulus</th>
            </tr>
            <tr>
                <th>Verbal</th>
                <th>Abstrak</th>
                <th>Numeric</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->date_test }}</td>
                <td>{{ $data->event_id }}</td>
                <td>{{ $data->city }}</td>
                <td>{{ $data->total_peserta }}</td>
                <td>{{ $data->verbal }}</td>
                <td>{{ $data->abstrak }}</td>
                <td>{{ $data->numerical }}</td>
                <td>{{ $data->jumlah_lulus }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "2")
    <table class="table-report">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Jurusan</th>
                <th colspan="3">Nilai Rata Rata</th>
            </tr>
            <tr>
                <th>Verbal</th>
                <th>Abstrak</th>
                <th>Numeric</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->verbal }}</td>
                <td>{{ $data->abstrak }}</td>
                <td>{{ $data->numerical }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "3")
    <table class="table-report">
        <thead>
            <tr>
                <th>No</th>
                <th>Universitas</th>
                <th>Total Peserta</th>
                <th>Total Perserta Lulus</th>
                <th>Total Peserta Gagal</th>
                <th>Presentase Kelulusan</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->universitas }}</td>
                <td>{{ $data->total_peserta }}</td>
                <td>{{ $data->jumlah_lulus }}</td>
                <td>{{ $data->jumlah_gagal }}</td>
                <td>{{ $data->persentase_lulus }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "4")
    <table class="table-report">
        <thead>
            <tr>
                <th>No</th>
                <th>Jurusan</th>
                <th>Total Peserta</th>
                <th>Total Perserta Lulus</th>
                <th>Total Peserta Gagal</th>
                <th>Presentase Kelulusan</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->total_peserta }}</td>
                <td>{{ $data->jumlah_lulus }}</td>
                <td>{{ $data->jumlah_gagal }}</td>
                <td>{{ $data->persentase_lulus }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "5")
    <table class="table-report">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Month</th>
                <th colspan="3">Nilai Rata Rata</th>
            </tr>
            <tr>
                <th>Verbal</th>
                <th>Abstrak</th>
                <th>Numeric</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->periode }}</td>
                <td>{{ $data->verbal }}</td>
                <td>{{ $data->abstrak }}</td>
                <td>{{ $data->numerical }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "6")
    <table class="table-report">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Job Application</th>
                <th colspan="6">Average Lead Time</th>
                <th rowspan="2">Total Lead Time</th>
            </tr>
            <tr>
                <th>Written Test</th>
                <th>Int. HR</th>
                <th>Int. User</th>
                <th>Int. Final</th>
                <th>MCU</th>
                <th>Hired</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->job_title }}</td>
                <td>{{ $data->average_wirrten_test }}</td>
                <td>{{ $data->average_hr_review }}</td>
                <td>{{ $data->average_final_review }}</td>
                <td>{{ $data->average_user_review }}</td>
                <td>{{ $data->average_mcu }}</td>
                <td>{{ $data->average_hired }}</td>
                <td>{{ $data->total_time }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "7")
    <table class="table-report">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Periode</th>
                <th colspan="3">Jumlah Pelamar</th>
            </tr>
            <tr>
                <th>D3</th>
                <th>S1</th>
                <th>S2</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->periode }}</td>
                <td>{{ $data->d3 }}</td>
                <td>{{ $data->s1 }}</td>
                <td>{{ $data->s2 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @elseif($tipe == "8")
    <table class="table-report">
        <thead>
            <tr>
                <th>No</th>
                <th>Kota</th>
                <th>Universitas</th>
                <th>Jurusan</th>
                <th>Gender</th>
                <th>Jumlah Kandidat</th>
            </tr>
        </thead>
        <tbody class="tbody-data">
        @php $no = 1; @endphp
        @foreach($downloadData as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->kota }}</td>
                <td>{{ $data->universitas }}</td>
                <td>{{ $data->jurusan }}</td>
                <td>{{ $data->gender }}</td>
                <td>{{ $data->total_kandidat }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>