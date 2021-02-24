@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear">
    <!-- <div class="row">
        <div class="col-lg-6 col-md-6 margin-left-20">
            <p><a href="{{route('get.news.event')}}"><img src="{{asset('image/icon/main/iconBack.svg')}}" class="margin-right-20" title="Kembali"></a>Tambah News/Event</p>
        </div>
    </div> -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('post.news.event.add') }}" class="form stacked" method="POST" id="formAddEventNews" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xl-2 col-md-3">
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <img src="{{ asset('image/icon/main/add-image.png') }}" alt="icon">
                                                <p>Upload Image</p>
                                            </div>
                                            <input type="file" name="imageNewsEvent" class="dropzone" id="imageNewsEvent">
                                        </div>
                                        <small>*Jpeg(.jpg or .jpeg) max 2mb</small>
                                    </div>
                                    <div class="col-xl-10 col-md-9">
                                        <div class="input-title-news">
                                            <h4 class="mb-4">Title</h4>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <img src="{{ asset('image/icon/main/add-circle.svg') }}" alt="icon">
                                                </div>
                                                <input type="text" class="form-control" name="titleNewsEvent" id="titleNewsEvent" placeholder="Add a News & Event titles...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="tipeNewsEventDiv">
                            <div class="form-group" >
                                <div class="row">
                                    <div class="col-10">
                                        <label>Type News/Event</label>
                                        <select class="select2 tex-center select2-width" id="tipeNewsEvent" name="tipeNewsEvent">
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="1">News</option>
                                            <option value="2">Event</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden" id="divDateNewsEvent">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Start Date News/Event</label>
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                        <input id="tglMulaiNewsEvent" name="tglMulaiNewsEvent" class="form-control datepicker dateNewsEvent" type="text" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>End Date News/Event</label>
                                <div class="row">
                                    <div class="col-md-10 col-10">
                                    <input id="tglSelesaiNewsEvent" name="tglSelesaiNewsEvent" class="form-control datepicker dateNewsEvent" type="text" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <div class="form-group">
                                <label>Description News/Event</label>
                                <div class="summernote-news-wrapper">
                                    <textarea name="descriptionNewsEvent" id="descriptionNewsEvent" class="form-control" placeholder="Input Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-11 col-lg-11 col-md-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection