@extends('main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<div class="card clear margin-right-20">
    <div class="row">
        <div class="col-lg-6 col-md-6 margin-left-20">
            <p><a href="{{route('get.news.event')}}"><img src="{{asset('image/icon/main/iconBack.svg')}}" class="margin-right-20" title="Kembali"></a>Tambah News/Event</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 margin-left-20">
            <form action="{{ route('post.news.event.add') }}" class="form stacked" method="POST" id="formAddEventNews" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <div><b>Preview</b></div>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-danger btn-sm remove-preview d-none">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="fas fa-file-image"></i>
                                    <p>Choose an image file or drag it here.</p>
                                </div>
                                <input type="file" name="imageNewsEvent" class="dropzone" id="imageNewsEvent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                            <label class="form-label font-color-label" for="titleNewsEvent">Title News/Event</label>
                            <div class="row">
                                <div class="col-md-12 col-10">
                                    <input id="titleNewsEvent" name="titleNewsEvent" class="form-input" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="tipeNewsEventDiv">
                        <div class="form-group" >
                            <label>Type News/Event</label>
                            <select class="select2 tex-center" id="tipeNewsEvent" name="tipeNewsEvent">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="1">News</option>
                                <option value="2">Event</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label font-color-label" for="tglMulaiNewsEvent">Start Date News/Event</label>
                            <div class="row">
                                <div class="col-md-10 col-10">
                                <input id="tglMulaiNewsEvent" name="tglMulaiNewsEvent" class="form-input datepicker" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label font-color-label" for="tglSelesaiNewsEvent">End Date News/Event</label>
                            <div class="row">
                                <div class="col-md-10 col-10">
                                <input id="tglSelesaiNewsEvent" name="tglSelesaiNewsEvent" class="form-input datepicker" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                        <label>Description News/Event</label>
                        <textarea name="descriptionNewsEvent" id="descriptionNewsEvent" class="form-control" placeholder="Input Description"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection