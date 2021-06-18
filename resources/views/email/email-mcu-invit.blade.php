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

            .card-result{
                background: #E8F7EE;
                border-radius: 8px;
                height: 76px;
                padding-top:3px;
            }

            .text-result{
                font-style: normal;
                font-weight: 600;
                font-size: 18px;
                line-height: 22px;
                align-items: center;
                text-align: center;
                letter-spacing: -0.02em;
                color: #050401;
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
            <img src="http://dev-adm-app.southeastasia.cloudapp.azure.com/image/icon/email/icon_logo.png" class="img-top">
        </center>
        <div class="container">
            <div class="card">
                <center>
                    <img src="http://dev-adm-app.southeastasia.cloudapp.azure.com/image/icon/email/icon_written_test_result.png" class="img-title">
                </center>
                <p class="title-email">Medical Check Up Invitation</p>
                <p class="subtitle-email">You’re invited to PT Astra Daihatsu Motor Medical Check Up</p>
                <div class="card-content">
                    <p class="title-content-email">Hello, {{$data['nama']}}</p>
                    <p class="content-email">Congratulation! You’ve passed all the interview process successfully and the next step is Medical Check Up. We would like to conduct your medical check up on :</p>
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
                            <td class="content-email">Location/Media</td>
                            <td class="value-table">{{$data['lokasi']}}</td>
                        </tr>
                    </table>
                    <p class="content-email"><span class="footer-email">Note :</span> Please do fasting for about 12 hours (can drink mineral water) before check up, print & bring hardcopy of the reference letter for MCU, Residential Identity Car (KTP) original & copy, and 2 pcs ID Photo (size 3x4)</p>
                    <p class="content-email">Within this email, we attached your MCU Reference letter (password : adm).</p>
                    <p class="content-email">Kindly confirm by today at the latest upon your attendance by replying to this e-mail.</p>
                    <hr>
                    <p class="content-email">Looking forward to hearing back from you soon!</p>
                </div>
                <center>
                    <p class="footer-email"><span class="span-footer">Regards,</span><br>Recruitment Team<br>PT Astra Daihatsu Motor</p>
                </center>
            </div>
        </div>
    </body>
</html>