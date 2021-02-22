@extends('admin.main.main')
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
            <form action="{{ route('post.news.event.edit') }}" class="form stacked" method="POST" id="formEditEventNews" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idNewsEvent" value="{{$data['id']}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xl-2 col-md-3">
                                    <div class="dropzone-wrapper">
                                        <div class="dropzone-desc top-0">
                                            @if($data['image'] == '' || $data['image'] == null)
                                            <img src="{{ asset('image/icon/main/add-image.png') }}" alt="icon">
                                            <p>Upload Image</p>
                                            @else
                                            <img src="{{ asset('storage/').'/'.$data['image'] }}" class="img-detail" alt="Image News/Event" width="100%">
                                            @endif
                                        </div>
                                        <input type="file" name="imageNewsEvent" class="dropzone" id="imageNewsEvent">
                                        <input type="hidden" name="oldImage" value="{{$data['image']}}">
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
                                            <input type="text" class="form-control" name="titleNewsEvent" id="titleNewsEvent" placeholder="Add a News & Event titles..." value="{{$data['title']}}">
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
                            <label>Type News/Event</label>
                            <select class="select2 tex-center select2-width" id="tipeNewsEvent" name="tipeNewsEvent">
                                <option value="">-- Pilih Tipe --</option>
                                <option {{$data['type'] == '1' ? 'selected' : ''}} value="1">News</option>
                                <option {{$data['type'] == '2' ? 'selected' : ''}} value="2">Event</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row {{$data['type'] == '1' ? 'hidden':''}}" id="divDateNewsEvent">
                    <div class="col-6">
                        <div class="form-group focused">
                            <label class="form-label font-color-label" for="tglMulaiNewsEvent">Start Date News/Event</label>
                            <div class="row">
                                <div class="col-md-10 col-10">
                                <input id="tglMulaiNewsEvent" name="tglMulaiNewsEvent" class="form-input datepicker dateNewsEvent" type="text" value="{{$data['start_date']}}" {{$data['type'] == '1' ? 'disabled':''}}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group focused">
                            <label class="form-label font-color-label" for="tglSelesaiNewsEvent">End Date News/Event</label>
                            <div class="row">
                                <div class="col-md-10 col-10">
                                <input id="tglSelesaiNewsEvent" name="tglSelesaiNewsEvent" class="form-input datepicker dateNewsEvent" type="text" value="{{$data['end_date']}}" {{$data['type'] == '1' ? 'disabled':''}}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11">
                        <div class="form-group">
                        <label>Description News/Event</label>
                        <textarea name="descriptionNewsEvent" id="descriptionNewsEvent" class="form-control" placeholder="Input Description">{{$data['content']}}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection