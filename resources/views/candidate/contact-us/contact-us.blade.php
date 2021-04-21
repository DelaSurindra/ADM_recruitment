@extends('candidate.main-homepage.main')
@section('content')
<div class="main-container-contact-us">
    <div class="heading-container-contact-us">
        <div class="row">
            <div class="col-sm-5">
                <h1>Contact Us</h1>
                <br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <h2>Head Office</h2>
                <br />
                <h3>
                    <ul>
                        <li>Jl. Gaya Motor III, No,5, Sunter II, Jakarta 14330,<br />Telp (021) 6510 300</li>
                        <br />
                    </ul>
                </h3>
                <h2>Sunter Plant</h2>
                <br />
                <h3>
                    <ul>
                        <li>
                        <b>Sunter Assembly Plant :</b><br />
                        Jl. Gaya Motor Barat, No.4, Sunter II, Jakarta 14330,
                        <br />Telp (021) 6531 0202
                        </li>
                        <br />
                        <li>
                        <b>Sunter Press Plant :</b><br />
                        Jl. Gaya Motor II No. 2, Sunter II, Jakarta 14330,
                        <br />Telp (021) 6511 792
                        </li>
                        <br />
                    </ul>
                </h3>
                <h2>Parts Center</h2>
                <br />
                <h3>
                    <ul>
                        <li>Jl. Selayar Blok A6, Kawasan Industri MM2100 Cibitung <br />Bekasi 17520, Telp (021) 8998 2299</li>
                        <br />
                    </ul>
                </h3>
            </div>
            <div class="col-sm-5">
                <h2>Karawang Plant</h2>
                <br />
                <h3>
                    <ul>
                        <li>
                            <b>Karawang Assembly Plant and R&D Center:</b><br />
                            Kawasan Industri Suryacipta Karawang, Jl. Surya<br />Pratama Blok I Kav. 50 AB<br />Karawang 41361, Telp (021) 2957 6900
                        </li>
                        <br />
                        <li>
                            <b>Karawang Engine Plant :</b><br />
                            Jl. Maligi VI-M16, Kawasan Industri KIIC, Jl. Tol Jakarta,<br />Cikampek KM 47<br />Karawang 41361, Telp (021) 8911 4030
                        </li>
                        <br />
                        <li>
                            <b>Karawang Casting Plant :</b><br />
                            Jl. Maligi Raya Lot A5, Kawasan Industri KIIC, Jl. Tol<br />Jakarta, CIkampek KM 47<br />
                            Karawang 41361, Telp (021) 8901495
                        </li>
                    </ul>
                </h3>
            </div>
        </div>
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
</div>
@endsection