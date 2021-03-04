@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')

<form action="{{ route('post.news.event.add') }}" class="form stacked" method="POST" id="formAddEventNews" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
            <div class="card clear">
            <!-- <div class="row">
                <div class="col-lg-6 col-md-6 margin-left-20">
                    <p><a href="{{route('get.news.event')}}"><img src="{{asset('image/icon/main/iconBack.svg')}}" class="margin-right-20" title="Kembali"></a>Tambah News/Event</p>
                </div>
            </div> -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <p class="text-title-page-small">Create</p>
                            <p class="text-title-page-big">News & Event</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @csrf
                            <div class="row">
                                <div class="col-lg-11 col-md-12">
                                    <div class="form-group">
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <img src="{{ asset('image/icon/main/ilusi-upload-gambar.svg') }}" alt="icon">
                                                <p>Upload Banner with Minimum resolution 1400x700</p>
                                            </div>
                                            <input type="file" name="imageNewsEvent" class="dropzone" id="imageNewsEvent">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-title-news">
                                <h4 class="mb-4">Enter News & Event Title</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 col-md-12">
                                    <div class="form-group">
                                        <label>Title<span class="required-sign">*</span></label>
                                        <input id="titleNewsEvent" name="titleNewsEvent" class="form-control form-hr" type="text" placeholder="Add a News & Event titles">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-6" id="tipeNewsEventDiv">
                                    <div class="form-group" >
                                        <label>Type<span class="required-sign">*</span></label>
                                        <select class="select2 tex-center select2-width" id="tipeNewsEvent" name="tipeNewsEvent">
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="1">News</option>
                                            <option value="2">Event</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 hidden" id="divDateNewsEvent">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Activate Date<span class="required-sign">*</span></label>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="tglMulaiNewsEvent" name="tglMulaiNewsEvent" class="form-control form-hr datepicker dateNewsEvent" type="text" placeholder="Choose date" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="text-white">End Date News/Event</label>
                                                <div class="row mt-1">
                                                    <div class="col-12">
                                                        <input id="tglSelesaiNewsEvent" name="tglSelesaiNewsEvent" class="form-control form-hr datepicker dateNewsEvent" type="text" placeholder="Choose date" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 col-md-12">
                                    <div class="form-group">
                                        <label>Content<span class="required-sign">*</span></label>
                                        <div class="summernote-news-wrapper">
                                            <textarea name="descriptionNewsEvent" id="descriptionNewsEvent" class="form-control" placeholder="Input Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-5">
            <div class="row">
                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                    <label class="mb-lg-0 mb-md-3 label-req-bottom"><span class="required-sign">*</span> Required</label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <button type="submit" class="btn btn-red w-100">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection