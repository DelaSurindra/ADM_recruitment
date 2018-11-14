<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="icon" type="image/png" href="img/favicon.png" />
  <title>Form Recruitment</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />
  <met http-equiv="CACHE-CONTROL" content="NO-CACHE">

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
    <link href="{{asset('assets/css/datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </met>
</head>
<body>
  <div class="detail">
    <div class="row margin-top">
      <div class="col-sm-6 col-sm-offset-3">
        <p class="text-center title-slider">Berikut requirement untuk posisi yang kamu pilih,</p>
                  <p class="text-center title-slider">Tekan apply untuk memilih posisi {{$data->job_title}} :)</p>
        </div>
      </div>
      <div class="spaceDetail">
        <div class="buttonBack">
          <a href="{{route('slider')}}"><i class="fa fa-angle-left" ></i> Back</a>
        </div>
        
        <div class="col-sm-8 col-sm-offset-2 card wizard-container">
          <div class="detail-left">
            <img id="imageid" src="{{$data->job_poster}}">
          </div>
          <div class="detail-right">
            <p class="detailTitle">{{$data->job_title}}</p>
            <hr>
            <p class="jobDes">{{$data->job_description}}</p>
            <p class="detailTitle">Requirement</p>
            <hr>
            <ul>
              {!! $data->job_Req !!}
            </ul>
            <div class="btnSubmit">
              <p style="">If you feel like you are the talented
              that could work with our team apply now!</p>
              <a href="{{route('form',$data->job_id)}}" class="btn btn-primary"> Apply Now
              </a>

            </div>

          </div>
        </div>
        
      </div>
    </div>
  </body>
  <script type="text/javascript">

  </script>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

  <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
  <script src="{{asset('assets/js/jquery.validate.min.js')}}" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
  <!--  Plugin for the Wizard -->
  <script src="{{asset('js/custom.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->

  <script src="{{asset('js/datepicker.min.js')}}" type="text/javascript"></script>
  </html>