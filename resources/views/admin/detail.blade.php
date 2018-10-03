@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 main-content">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-10">
                        <h4><strong>{{ $pelamar->lastname }}</strong> ({{ $job }})</h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{ route('pelamar')}}" class="btn btn-outline-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>

                <hr>


                <table class="table" style="width: 50%">
                    <tbody>
                        <tr>
                            <th class="text-right" style="width: 30%">Nama</th>
                            <td scope="col">: {{ $pelamar->lastname }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">Tempat Lahir</th>
                            <td>: {{ $pelamar->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">Tanggal Lahir</th>
                            <td>: {{ $pelamar->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">Alamat</th>
                            <td>: {{ $pelamar->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">Email</th>
                            <td>: {{ $pelamar->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">No HP</th>
                            <td>: {{ $pelamar->no_hp }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">Lulusan</th>
                            <td>: {{ $pelamar->jurusan }}, {{ $pelamar->kampus }}</td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width: 30%">CV</th>
                            <td>: 
                                @if($pelamar->file_cv)
                                    <a href="{{ url('pelamar/download/'.$pelamar->id) }}" target="_blank" type="button" class="btn btn-success">Download</a>
                                @else
                                    Belum Upload CV
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
