@extends('admin.main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card clear">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <p class="title-page"><img src="{{asset('image/icon/main/icon_title_homepage.svg')}}" alt=""> Manage Homepage</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="title-homepage">Color Scheme</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorBlue">
                                    <input type="hidden" name="color" value="blue">
                                    <button class="btn btn-home-color blue"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'blue' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorDarkBlue">
                                    <input type="hidden" name="color" value="dark-blue">
                                    <button class="btn btn-home-color dark-blue"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'dark-blue' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorGreen">
                                    <input type="hidden" name="color" value="green">
                                    <button class="btn btn-home-color green"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'green' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorGrey">
                                    <input type="hidden" name="color" value="grey">
                                    <button class="btn btn-home-color grey"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'grey' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorPurple">
                                    <input type="hidden" name="color" value="purple">
                                    <button class="btn btn-home-color purple"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'purple' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorRed">
                                    <input type="hidden" name="color" value="red">
                                    <button class="btn btn-home-color red"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'red' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('post.edit.color')}}" method="POST" class="form stacked form-hr" ajax="true" id="formEditColorYellow">
                                    <input type="hidden" name="color" value="yellow">
                                    <button class="btn btn-home-color yellow"><img src="{{asset('image/icon/main/icon_check_color.svg')}}" class="{{$color == 'yellow' ? '' : 'hidden'}}"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="title-homepage">Banner</p>
                            </div>
                        </div>
                        @if($banner == [])
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{asset('image/icon/main/icon_banner_empty.svg')}}">
                            </div>
                            <div class="col-md-10">
                                <p class="title-empty-banner">You dont have any banner</p>
                                <p class="text-empty-banner mb-3">Please add some picture to beautify your homepage</p>
                                <button class="btn btn-red" data-toggle="modal" data-target="#modalAddBanner">Add Banner</button>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            @foreach($banner as $data)
                            <div class="col-md-4">
                                <input type="hidden" id="valueBanner{{$data['id']}}" value="{{$data['value']}}">
                                <img src="{{ asset('storage/').'/'.$data['value'] }}" alt="" class="img-banner">
                                <div class="d-flex div-btn-banner">
                                    <button type="button" class="btn btn-table btn-banner mr-2 edit-banner" value="{{$data['id']}}"><img style="margin-right: 1px;" src="{{asset('image/icon/main/edit.svg')}}" title="Edit Banner">&nbsp Edit&nbsp</button>
                                    @if(count($banner) > 1)
                                    <button type="button" class="btn btn-table btn-banner delete-banner" value="{{$data['id']}}"><img style="margin-right: 1px;" src="{{asset('image/icon/main/delete_red.svg')}}" title="Delete Banner">&nbspDelete</button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @if(count($banner) < 3)
                <div class="row mt-2">
                    <div class="col-md-5"></div>
                    <div class="col-md-7">
                        <button class="btn btn-red" data-toggle="modal" data-target="#modalAddBanner">Add Banner</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="modalAddBanner" aria-labelledby="modalAddBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Upload</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <!-- <p class="text-add-bulk">You can upload maximum 3 pictures</p> -->
                <form action="{{route('post.add.banner')}}" method="POST" class="form stacked form-hr" enctype="multipart/form-data" id="formAddBanner">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">
                                        <img src="{{ asset('image/icon/main/icon_banner_upload.svg') }}" alt="icon">
                                        <p class="file-input-label">Minimum resolution 1400x700</p>
                                    </div>
                                    <input type="file" name="fileBanner" class="dropzone" id="fileBanner" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100" id="btnAddBanner" disabled>Done</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditBanner" aria-labelledby="modalEditBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Edit Banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <!-- <p class="text-add-bulk">You can upload maximum 3 pictures</p> -->
                <form action="{{route('post.edit.banner')}}" method="POST" class="form stacked form-hr" enctype="multipart/form-data" id="formEditBanner">
                    @csrf
                    <input type="hidden" name="idBanner" id="idBanner">
                    <input type="hidden" name="oldBanner" id="oldBanner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">
                                        <img src="" alt="icon" id="imageBanner" class="img-edit-banner">
                                    </div>
                                    <input type="file" name="fileBannerEdit" class="dropzone" id="fileBannerEdit" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteBanner" aria-labelledby="modalDeleteBannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-hr">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-up">
                    <h4 class="modal-hr-title mb-0">Edit Banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('image/icon/homepage/icon-silang.svg') }}" class="this-icon click deleteThis" alt="icon">
                    </button>
                </div>
                <p class="text-add-bulk">Are you sure delete this banner?</p>
                <form action="{{route('post.delete.banner')}}" method="POST" class="form stacked form-hr" ajax="true" id="formDeleteBanner">
                    @csrf
                    <input type="hidden" name="idDeleteBanner" id="idDeleteBanner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <img src="" alt="icon" id="imageDelete" class="img-edit-banner">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-red w-100">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection