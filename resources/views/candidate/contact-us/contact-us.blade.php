@extends('candidate.main-homepage.main')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <p class="title-contact">Contact Us</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-5">
            <p class="content-contact">Head Office</p>
            <h3>
                <ul>
                    <li class="li-contact">Jl. Gaya Motor III, No,5, Sunter II, Jakarta 14330,<br />Telp (021) 6510 300</li>
                </ul>
            </h3>
            <br>
            <p class="content-contact">Sunter Plant</p>
            <h3>
                <ul>
                    <li class="li-contact">
                    <p class="text-contact">Sunter Assembly Plant :</p>
                    Jl. Gaya Motor Barat, No.4, Sunter II, Jakarta 14330,
                    <br />Telp (021) 6531 0202
                    </li>
                    <br />
                    <li class="li-contact">
                    <p class="text-contact">Sunter Press Plant :</p>
                    Jl. Gaya Motor II No. 2, Sunter II, Jakarta 14330,
                    <br />Telp (021) 6511 792
                    </li>
                    <br />
                </ul>
            </h3>
            <p class="content-contact">Parts Center</p>
            <h3>
                <ul>
                    <li class="li-contact">Jl. Selayar Blok A6, Kawasan Industri MM2100 Cibitung <br />Bekasi 17520, Telp (021) 8998 2299</li>
                    <br />
                </ul>
            </h3>
        </div>
        <div class="col-sm-5">
            <p class="content-contact">Karawang Plant</p>
            <h3>
                <ul>
                    <li class="li-contact">
                        <p class="text-contact">Karawang Assembly Plant and R&D Center:</p><br />
                        Kawasan Industri Suryacipta Karawang, Jl. Surya<br />Pratama Blok I Kav. 50 AB<br />Karawang 41361, Telp (021) 2957 6900
                    </li>
                    <br />
                    <li class="li-contact">
                        <p class="text-contact">Karawang Engine Plant :</p><br />
                        Jl. Maligi VI-M16, Kawasan Industri KIIC, Jl. Tol Jakarta,<br />Cikampek KM 47<br />Karawang 41361, Telp (021) 8911 4030
                    </li>
                    <br />
                    <li class="li-contact">
                        <p class="text-contact">Karawang Casting Plant :</p><br />
                        Jl. Maligi Raya Lot A5, Kawasan Industri KIIC, Jl. Tol<br />Jakarta, CIkampek KM 47<br />
                        Karawang 41361, Telp (021) 8901495
                    </li>
                </ul>
            </h3>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <p class="title-contact">Get In Touch With Us</p>
        </div>
    </div>
    <form action="" class="form-candidate-view">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name<span class="required-sign">*</span></label>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <input type="text" name="nameContact" id="nameContact" class="form-control" placeholder="Your Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email<span class="required-sign">*</span></label>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <input type="text" name="emailContact" id="emailContact" class="form-control" placeholder="Your Email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Message<span class="required-sign">*</span></label>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <textarea name="messageContact" id="messageContact" class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 d-flex align-items-center">
                        <label class="mb-lg-0 mb-md-3"><span class="required-sign">*</span> Required</label>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 d-flex">
                                <button type="submit" class="btn btn-home-color btn-block">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- <div class="main-container-contact-us">
    <div class="heading-container-contact-us">
        
    </div>
    <div class="content-container-contact-us">
        <h1>Get In Touch With Us</h1>
        <br /><br />
        <form class="row g-3 needs-validation" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Name*</label>
                <input type="text" class="form-control" placeholder="Your name" id="validationCustom01" required />
            </div>
            <div class="col-md-4">
                <label for="validationCustom02" class="form-label">Email*</label>
                <input type="text" class="form-control" placeholder="example@gmail.com" id="validationCustom02" required />
            </div>
            <br />
            <div class="col-md-8">
                <label for="validationCustom03" class="form-label">Message</label>
                <textarea class="form-control" placeholder="Your message" id="validationCustom03" required style="margin: 0px 3px 0px 0px; height: 145px" required></textarea>
            </div>
        </form>
        <br />
        <form class="row g-3 needs-validation" novalidate>
            <div class="col-4">
                <h3><b>*Required</b></h3>
            </div>
            <div class="d-grip col-4">
                <button class="btn btn-primary" type="submit" required style="width: 400px; background-color: #df0e2c">Submit form</button>
            </div>
        </form>
    </div>
</div> -->
@endsection