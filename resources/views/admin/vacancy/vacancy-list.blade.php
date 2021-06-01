@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="title-page"><img src="{{asset('image/icon/main/icon_title_vacancy.svg')}}" alt=""> Manage Vacancy</p>
            </div>
            <div class="col-md-6">
                <a href="{{route('get.vacancy.add')}}"><button type="button" class="btn btn-red right">Add Vacancy</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tableVacancy" class="table-hr table table-strip stripe hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Job Type</th>
                            <th>Degree</th>
                            <th>Major</th>
                            <th>Location</th>
                            <th>Working TIme</th>
                            <th>Actived Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('modal')
<div class="modal fade" id="modalKonfirmVacancy" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-color" id="titleModalKonfirmVacancy"></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="{{route('post.vacancy.delete')}}" id="formDeleteVacancy" method="post" ajax="true" class="form stacked">
                                <div class="form-multi-row row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" id="titleKonfirmasiVacancy"></label>
                                        <input id="idDeleteVacancy" class="form-input" type="hidden" name="idDeleteVacancy" />
                                        <input id="tipeDeleteVacancy" class="form-input" type="hidden" name="tipeDeleteVacancy" />
                                    </div>
                                </div>
                                </br>
                                <div class="right">
                                    <button type="button" class="left btn btn-back" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn bnt-login btn-hapus-modal" id="btnKonfirmasiVacancy"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection