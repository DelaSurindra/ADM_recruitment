@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 main-content">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="form-inline col-10">
                        <h4><strong>{{ $pelamar->lastname }}</strong> ({{ $job }}) </h4>
                    </div>
                    <div class="form-inline col justify-content-end">
                        <a href="{{ route('pelamar')}}" class="btn btn-outline-primary">Back</a>
                    </div>
                </div>

                <hr>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">

                    <div class="col">
                        <table class="table">
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
                                            <a href="{{ url('admin/pelamar/download/'.$pelamar->id) }}" target="_blank" type="button" class="btn btn-success">Download</a>
                                        @else
                                            Belum Upload CV
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col">
                        <h5>Curent Status : 
                            @if($pelamar->status == 'APLY')
                                <span class="badge badge-pill badge-warning">Applied</span>
                            @elseif($pelamar->status == 'INTV')
                                <span class="badge badge-pill badge-info">Interview</span>
                            @elseif($pelamar->status == 'ACPT')
                                <span class="badge badge-pill badge-info">Accepted</span>
                            @elseif($pelamar->status == 'RJCT')
                                <span class="badge badge-pill badge-info">Rejected</span>
                            @endif
                        </h5>
                        <hr>
                        <form action="{{ url('admin/pelamar/status/'.$pelamar->id) }}" method="post">
                            <label>Change Current Status Applicant</label>
                            <div class="input-group">
                                <select class="custom-select" name="status">
                                    <option selected>Choose...</option>
                                    <option value="INTV">Interview</option>
                                    <option value="ACPT">Accepted</option>
                                    <option value="RJCT">Rejected</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="submit">Change</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
