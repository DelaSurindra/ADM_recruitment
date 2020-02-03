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
  
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '2648797392022220'); fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2648797392022220&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
    
</head>
<body>
  <div class="detail"> 
  <nav class="navbar navbar-light bg-light header-vascomm">
    <div class="container">
      <a class="navbar-brand" href="https://career.vascomm.co.id/">
        <img src="/assets/img/logo.png"  class="d-inline-block align-top logo-vascomm" alt="">
      </a>
      <a href="https://vascomm.co.id/" class="btnVisit">Visit us</a>
    </div>
    </nav>  
    <div class="spaceDetail">
      <div class="container">
        <div class="buttonBack">
          <a href="{{route('slider')}}">
            <i class="fa fa-angle-left arrow" ></i> Back
          </a>
        </div>
        <div class="col-sm-10 col-sm-offset-1 card  card-detail">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="detail-left">
                <img id="imageid" src="{{$data->job_poster}}">
              </div>
            </div>
            <div class="col-md-8 col-sm-12">
              <div class="detail-right">
                <p class="detailTitle">{{$data->job_title}}</p>
                <hr>
                {!! $data->job_description !!}
                <hr>
                <p class="detailTitle">Requirement</p>
                <hr>
                
                {!! $data->job_Req !!}
      
              </div>
            </div>
            <div class="col-sm-12">
                <div class="btnSubmit">
                  <a href="{{route('form',$data->job_id)}}" class="btn-daftar"> Apply Now
                  </a>
                </div>
              </div>            
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