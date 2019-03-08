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
  @if(Session::has("error_msg"))
  <input type="hidden" name="error_msg" value="{{Session::get('error_msg')}}">
  @endif

  @if(Session::has('success_msg'))
  <input type="hidden" name="success_msg" value="{{Session::get('success_msg')}}">
  @endif
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="">
      <img src="/assets/img/logo.png" height="40" class="d-inline-block align-top" alt=""> </a>
      <a href="https://vascomm.co.id/" class="btnVisit">Visit us</a>
    </nav>
    <div class="container">
      <div class="row margin-top">
        <div class="col-md-12">
          <p class="text-center title-slider">Hello, NuCommers! <br> Please choose position you would like to apply.</p>
        </div>
      </div>
      <div class="masonry">
        @foreach($positions as $key=>$_pos)                        
        <div class="">
          <a href="{{route('detail',$_pos->job_id)}}"><img src="{{asset('/'.$_pos->job_poster)}}" class="poster"></a>
        </div>
        @endforeach
      </div>
    </div>
    <!-- <div class="slider_option">
  <input type="checkbox" id="checkbox">
  <label for="checkbox">Autoplay Slider</label>
</div> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>