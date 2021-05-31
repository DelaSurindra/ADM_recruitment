<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADM Recruitment</title>

        <style>
            .img-top{
                margin-top:40px;
                margin-bottom:20px;
            }

            .container{
                padding-right: 48px;
                padding-left: 48px;
                padding-bottom: 48px;
            }

            .card{
                background: #FFFFFF;
                border-radius: 10px;
                padding-left: 60px;
                padding-right: 60px;
                padding-bottom: 15px;
            }

            .img-title{
                margin-top:30px;
            }

            .title-email{
                font-style: normal;
                font-weight: bold;
                font-size: 24px;
                line-height: 29px;
                align-items: center;
                text-align: center;
                letter-spacing: -0.02em;
                color: #050401;
                margin-top:10px;
            }

            .subtitle-email{
                font-style: normal;
                font-weight: normal;
                font-size: 18px;
                line-height: 22px;
                text-align: center;
                letter-spacing: -0.02em;
                color: #050401
            }

            .card-content{
                border: 1px solid #E0E0E0;
                box-sizing: border-box;
                border-radius: 8px;
                padding:32px;
                margin: 40px 26%;
                width: 50%;
            }

            .title-content-email{
                font-style: normal;
                font-weight: 600;
                font-size: 18px;
                line-height: 22px;
                display: flex;
                align-items: center;
                letter-spacing: -0.02em;
                color: #050401;
            }

            .content-email{
                font-style: normal;
                font-weight: normal;
                font-size: 14px;
                line-height: 150%;
                color: #504F4D;
            }

            .footer-email{
                font-style: normal;
                font-weight: 600;
                font-size: 14px;
                line-height: 150%;
                text-align: center;
                color: #504F4D;
            }

            .span-footer{
                font-weight:normal !important;
            }

            .value-table{
                font-style: normal;
                font-weight: 600;
                font-size: 14px;
                line-height: 150%;
                text-align: right;
                color: #504F4D;
            }

            .btn-red{
                background: #DF0E2C;
                color: #FFFFFF;
                box-sizing: border-box;
                border-radius: 8px;
                font-style: normal;
                font-weight: bold;
                font-size: 14px;
                line-height: 17px;
                padding: 12px;
                width:100%;
                border:none;
                cursor: pointer;
                height: 54px;
                margin-bottom:10px;
            }

            .btn-green{
                background: #E8F7EE;
                color: #DF0E2C;
                box-sizing: border-box;
                border:1px solid #DF0E2C;
                border-radius: 8px;
                font-style: normal;
                font-weight: bold;
                font-size: 14px;
                line-height: 17px;
                padding: 12px;
                width:100%;
                cursor: pointer;
                height: 54px;
            }
        </style>
    </head>
    <body style="font-family: 'inter_bold', sans-serif;line-height: 1.6; background:#E8F7EE;">
        <center>
            <img src="https://adm.vasdev.co.id/image/icon/email/icon_logo.png" class="img-top">
        </center>
        <div class="container">
            <div class="card">
                <center>
                    <img src="https://adm.vasdev.co.id/image/icon/email/icon_written_test_invit.png" class="img-title">
                </center>
                <p class="title-email">Written Test Invitation</p>
                <p class="subtitle-email">You’re invited to PT Astra Daihatsu Motor Written test</p>
                <div class="card-content">
                    <p class="title-content-email">Hello, {{$data['nama']}}</p>
                    <p class="content-email">Congratulation! We found your profile match our needs for the role. You’ve passed our administration selection and we would like to invite you to join our written test on :</p>
                    <table style="width:100%;">
                        <tr style="height:40px;">
                            <td class="content-email">Day/Date</td>
                            <td class="value-table">{{$data['tanggal']}}</td>
                        </tr>
                        <tr style="height:40px;">
                            <td class="content-email">Time</td>
                            <td class="value-table">{{$data['waktu']}}</td>
                        </tr>
                        <tr style="height:40px;">
                            <td class="content-email">Location</td>
                            <td class="value-table">{{$data['lokasi']}}</td>
                        </tr>
                        <tr style="height:40px;">
                            <td class="content-email">Item Need to Prepare</td>
                            <td class="value-table">KTP And Test Device</td>
                        </tr>
                    </table>
                    <p class="content-email">Please kindly complete your data profile and confirm your attendance at the latest <span class="footer-email">{{$data['tanggal']}}</span> <br> If you need a reschedule, kindly check our available schedule on ‘reschedule’ menu.</p>
                    <a href="https://adm.vasdev.co.id"><button class="btn-red">Confirmation Test</button></a>
                    <!-- <a href="https://adm.vasdev.co.id"><button class="btn-green">Reschedule Test</button></a> -->
                    <hr>
                    <p class="content-email">Thank you and see you soon !</p>
                </div>
                <center>
                    <p class="footer-email"><span class="span-footer">Regards,</span><br>Recruitment Team<br>PT Astra Daihatsu Motor</p>
                </center>
            </div>
        </div>
    </body>
</html>