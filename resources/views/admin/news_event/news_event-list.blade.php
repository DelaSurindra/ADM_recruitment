@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear margin-right-20">
    <div class="row">
        <div class="col-md-6">
            <p class="title-page"><img src="{{asset('image/icon/main/icon_title_candidate.svg')}}" alt=""> Manage News & Event</p>
        </div>
        <div class="col-md-6">
            <a href="{{route('get.news.event.add')}}"><button type="button" class="btn btn-red right">Add News & Event</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="tableNewsEvent" class="table-hr table table-strip stripe hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Tipe</th>
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

@endsection
@section('modal')
<div class="modal fade" id="modalKonfirmEventNews" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-color" id="titleModalKonfirmEventNews"></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="{{route('post.news.event.delete')}}" id="formDeleteNewsEvent" method="post" ajax="true" class="form stacked">
                                <div class="form-multi-row row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" id="titleKonfirmasiEventNews"></label>
                                        <input id="idDeleteNewsEvent" class="form-input" type="hidden" name="idDeleteNewsEvent" />
                                        <input id="tipeDeleteNewsEvent" class="form-input" type="hidden" name="tipeDeleteNewsEvent" />
                                    </div>
                                </div>
                                </br>
                                <div class="right">
                                    <button type="button" class="left btn btn-back" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn bnt-login btn-hapus-modal" id="btnKonfirmasiNewsEvent"></button>
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