<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slider</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    @if(Session::has("error_msg"))
  <input type="hidden" name="error_msg" value="{{Session::get('error_msg')}}">
  @endif

  @if(Session::has('success_msg'))
  <input type="hidden" name="success_msg" value="{{Session::get('success_msg')}}">
  @endif
    <div class="container">
        <div class="row margin-top">
            <div class="col-md-10 offset-md-2">
                <h4 class="center title-slider">Pilih salah satu posisi yang ingin kamu lamar</h4>
            </div>
        </div>
        <div id="slider">
            <a href="#" class="control_next">></a>
            <a href="#" class="control_prev"><</a> 
            <ul>
                @foreach($positions as $key=>$_pos)
                    <li><div class="android"><a href="{{route('form',$_pos->job_id)}}"><img src="{{asset($_pos->job_poster)}}"></a></div></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- <div class="slider_option">
  <input type="checkbox" id="checkbox">
  <label for="checkbox">Autoplay Slider</label>
</div> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>




</body>

</html>