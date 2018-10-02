<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="icon" type="image/png" href="img/favicon.png" />
  <title>Form Recruitment</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!-- CSS Files -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/paper-bootstrap-wizard.css')}}" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
<link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

  <!-- Fonts and Icons -->
  <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet">
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
  <link href="{{asset('assets/css/themify-icons.css')}}" rel="stylesheet">
</head>

<body>
  @if(Session::has("error_msg"))
  <input type="hidden" name="error_msg" value="{{Session::get('error_msg')}}">
  @endif

  @if(Session::has('success_msg'))
  <input type="hidden" name="success_msg" value="{{Session::get('success_msg')}}">
  @endif
  <div class="image-container set-full-height" style="background-image: url('{{asset("assets/img/paper-1.jpeg")}}')">

    <!--   Creative Tim Branding   -->
    <a href="#">
      <div class="logo-container">
        <div class="logo">
          <img src="{{asset('assets/img/vascomm_logo.png')}}">
        </div>
        <div class="brand">
          Vascomm<br>
          Recruitment
        </div>
      </div>
    </a>

    <!--   Big container   -->
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

          <!--      Wizard container        -->
          <div class="wizard-container">

            <div class="card wizard-card" data-color="blue" id="wizardProfile">
              <form action="{{route('submitLamaran')}}" method="post" enctype="multipart/form-data">
                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "blue", "green", "blue", "red", "azure"          -->

                <div class="wizard-header text-center">
                  <h3 class="wizard-title">Perkenalkan siapa kamu</h3>
                  <p class="category">Isi data dibawah ini ya kak</p>
                </div>

                <div class="wizard-navigation">
                  <div class="progress-with-circle">
                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                  </div>
                  <ul>
                    <li>
                      <a href="#about" data-toggle="tab">
                        <div class="icon-circle">
                          <i class="ti-user"></i>
                        </div>
                        Internal
                      </a>
                    </li>
                    <li>
                      <a href="#account" data-toggle="tab">
                        <div class="icon-circle">
                          <i class="ti-map"></i>
                        </div>
                        External
                      </a>
                    </li>
                    <li>
                      <a href="#address" data-toggle="tab">
                        <div class="icon-circle">
                          <i class="ti-files"></i>
                        </div>
                        CV
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane" id="about">
                    <div class="row">
                      <h5 class="info-text"> Hallo NuCommers, apa kamu sudah siap menjadi {{$jobTitle}} ?</h5>
                      <div class="col-sm-3 col-sm-offset-1">
                        <div class="form-group">
                          <label>Nama Panggilan</label>
                          <input name="firstname" type="text" class="form-control" placeholder="John..." value="{{old('firstname')}}">
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <label>Nama Panjang</label>
                          <input name="lastname" type="text" class="form-control" placeholder="Jhon Smith..." value="{{old('lastname')}}">
                        </div>
                      </div>
                      <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                          <label>Tanggal Lahir </label>
                          <input name="tanggal_lahir" type="date" class="form-control" placeholder="E.g. andrew@creative-tim.com" value="{{old('email')}}" required="">
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Tempat Lahir </label>
                          <input name="tempat_lahir" type="text" class="form-control" placeholder="E.g. Kota Surabaya" value="{{old('tempat_lahir')}}" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="account">
                    <h5 class="info-text"> Sedikit lagi nih kak </h5>
                    <div class="row">
                      <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                          <label>Alamat</label>
                          <input name="alamat" type="text" class="form-control" placeholder="Jl. Raya..." value="{{old('alamat')}}">
                        </div>
                      </div>
                      <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                          <label>No Handphone</label>
                          <input name="no_hp" type="number" class="form-control" placeholder="081231xxxxx" value="{{old('no_hp')}}" required="">
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>email</label>
                          <input name="email" type="email" class="form-control" placeholder="jhon@gmail.com" value="{{old('email')}}">
                        </div>
                      </div>
                      <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                          <label>Kampus </label>
                          <input name="kampus" type="text" class="form-control" placeholder="E.g. ITS" value="{{old('kampus')}}" required="">
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Jurusan </label>
                          <input name="jurusan" type="text" class="form-control" placeholder="E.g. Sistem Informasi" value="{{old('jurusan')}}" required="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="address">
                    <div class="row">
                      <div class="col-sm-12">
                        <h5 class="info-text"> Kalo mau submit CV kamu bisa disini bisa secara hardcopy di basecamp PT Vascomm ya. </h5>
                      </div>
                      <div class="col-sm-4 col-sm-offset-4">
                        <div class="picture-container">
                          <div class="picture">
                            <img src="{{asset('assets/img/default-avatar.jpg')}}" class="picture-src" id="wizardPicturePreview" title="" />
                            <input type="file" id="wizard-picture" name="file_cv">
                          </div>
                          <h6>Pilih CV mu</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wizard-footer">
                  <div class="pull-right">
                    <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' />
                    <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='Finish' />
                  </div>

                  <div class="pull-left">
                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                  </div>
                  <div class="clearfix"></div>
                </div>
                {{csrf_field()}}
              </form>
            </div>
          </div>
          <!-- wizard container -->
        </div>
      </div>
      <!-- end row -->
    </div>
    <!--  big container -->
  </div>

</body>

<!--   Core JS Files   -->
<script src="{{asset('assets/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="{{asset('assets/js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
<script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/custom.js')}}" type="text/javascript"></script>

</html>