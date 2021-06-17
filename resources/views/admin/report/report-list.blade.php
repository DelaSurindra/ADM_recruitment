@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="title-page"><img src="{{asset('image/icon/main/icon_title_report.svg')}}" alt=""> Report</p>
                    </div>
                    <div class="col-md-8">
                        <button type="button" data-toggle="modal" data-target="#modalFilterReport" class="btn btn-red right"><img src="{{asset('image/icon/main/icon_filter.svg')}}" alt="">&nbsp&nbspFilter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row div-report">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <center>
                    <img src="{{asset('image/icon/main/icon_empty_report.svg')}}" alt="">
                    <p class="title-empty-report mt-3">Reporting to much data</p>
                    <p class="text-empty-report">Use <span class="span-empty-report">Filter Feature</span> above to show data report that you want</p>
                </center>
            </div>
        </div>
    </div>
</div>

<!-- Tren Kelulusan -->
<div class="row div-report hidden" id="divTrenKelulusan">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Tren Kelulusan</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
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
                            <tbody class="tbody-data" id="tableTrenKelulusan">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Average Score VS Jurusan -->
<div class="row div-report hidden" id="divAverageScore">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Average Score VS Jurusan</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">Jurusan</th>
                                    <th colspan="3">Nilai Rata Rata</th>
                                </tr>
                                <tr>
                                    <th>Verbal</th>
                                    <th>Abstrak</th>
                                    <th>Numeric</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-data" id="tableAverageScore">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tingkat Kelulusan Per Universitas -->
<div class="row div-report hidden" id="divTingkatUniv">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Tingkat Kelulusan Per Universitas</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Universitas</th>
                                    <th>Total Peserta</th>
                                    <th>Total Perserta Lulus</th>
                                    <th>Total Peserta Gagal</th>
                                    <th>Presentase Kelulusan</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-data" id="tableTingkatUniv">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tingkat Kelulusan Per Jurusan -->
<div class="row div-report hidden" id="divTingkatJurusan">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Tingkat Kelulusan Per Jurusan</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jurusan</th>
                                    <th>Total Peserta</th>
                                    <th>Total Perserta Lulus</th>
                                    <th>Total Peserta Gagal</th>
                                    <th>Presentase Kelulusan</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-data" id="tableTingkatJurusan">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tren Average Score per Subtes -->
<div class="row div-report hidden" id="divTrenAverage">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Tren Average Score per Subtes</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">Month</th>
                                    <th colspan="3">Nilai Rata Rata</th>
                                </tr>
                                <tr>
                                    <th>Verbal</th>
                                    <th>Abstrak</th>
                                    <th>Numeric</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-data" id="tableTrenAverage">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Average fulfillment lead time per job vacancy -->
<div class="row div-report hidden" id="divAverageFull">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Average fulfillment lead time per job vacancy</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
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
                            <tbody class="tbody-data" id="tableAverageFull">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tren Applicant : Analisa jml peningkatan/penurunan jumlah pelamar -->
<div class="row div-report hidden" id="divTrenApplicant">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Tren Applicant : Analisa jml peningkatan/penurunan jumlah pelamar</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">Periode</th>
                                    <th colspan="3">Jumlah Pelamar</th>
                                </tr>
                                <tr>
                                    <th>D3</th>
                                    <th>S1</th>
                                    <th>S2</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-data" id="tableTrenApplicant">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Apply : analisa profil kandidat2 yang apply melalui web -->
<div class="row div-report hidden" id="divApply">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="title-page">Apply : analisa profil kandidat2 yang apply melalui web</p>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn-download-report"><button class="btn btn-white right">Download</button></a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <table class="table table-report table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kota</th>
                                    <th>Universitas</th>
                                    <th>Jurusan</th>
                                    <th>Gender</th>
                                    <th>Jumlah Kandidat</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-data" id="tableApply">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<div class="modal fade" id="modalFilterReport" aria-labelledby="modalFilterReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <form class="form stacked form-hr" filter="true" id="filterReport">
                    @csrf
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group d-flex flex-column">
                                <label>Data Category</label>
                                <select class="select2 form-control" id="categoryReport" name="categoryReport">
                                    <option value="1">Tren Kelulusan</option>
                                    <option value="2">Average Skor vs Jurusan</option>
                                    <option value="3">Tingkat kelulusan per Universitas</option>
                                    <option value="4">Tingkat kelulusan per Jurusan</option>
                                    <option value="5">Tren Average Skor per Subtest</option>
                                    <option value="6">Average fulfilment lead time per Job vacancy</option>
                                    <option value="7">Tren Applicant : Analisa Jumlah peningkatan / Penurunan Jumlah pelamar</option>
                                    <option value="8">Analisa Profil kandidat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row-date">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Date</label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="with-icon">
                                            <input type="text" class="form-control" placeholder="Choose date" name="dateStartReport" id="dateStartReport" value="{{date('d-m-Y')}}">
                                            <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <img src="{{asset('image/icon/homepage/icon-until.svg')}}" alt="" class="mt-3">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="with-icon">
                                            <input type="text" class="form-control" placeholder="Choose date" name="dateEndReport" id="dateEndReport" value="{{date('d-m-Y')}}">
                                            <img src="{{ asset('image/icon/homepage/icon-calender-input.svg') }}" class="this-icon" alt="icon" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden row-kota-univ">
                        <div class="col-md-11">
                            <div class="form-group d-flex flex-column">
                                <label>Kota</label>
                                <select class="select2 form-control" id="kotaReport" name="kotaReport">
                                    @foreach($wilayah as $dataWilayah)
                                        <option value="{{$dataWilayah['kabupaten']}}">{{$dataWilayah['kabupaten']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden row-kota-univ">
                        <div class="col-md-11">
                            <div class="form-group d-flex flex-column">
                                <label>Universitas</label>
                                <select class="select2 form-control" id="universitasReport" name="universitasReport">
                                    @foreach($universitas as $dataUniv)
                                        <option value="{{$dataUniv['universitas']}}">{{$dataUniv['universitas']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100" for="filterReport">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection