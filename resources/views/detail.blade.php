<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <title>NuComers Online Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="img/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="detail">
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="">
        <img src="/assets/img/logo.png" height="40" class="d-inline-block align-top" alt=""> </a>
      <a href="https://vascomm.co.id/" class="btnVisit">Visit us</a>
    </nav>
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
            
              {!! $data->job_Req !!}
            
            <div class="btnSubmit">
              <a href="{{route('form',$data->job_id)}}" class="btn-daftar"> Apply Now
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