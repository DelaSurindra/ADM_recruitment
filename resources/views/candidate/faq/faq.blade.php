@extends('candidate.main-homepage.main')
@section('content')
<div class="main-container" id="divFaq">
    <div class="heading-container">
        <h1>Frequently Asked Question</h1>
        <div class="search-bar">
            <img src="{{ asset('image/icon/homepage/icon-search-red.svg') }}">
            <span>Search Question or Answer</span>
        </div>
    </div>
    <div class="content-container">
        <div class="question-box">
            <div class="question1 tab-links" onclick="openContent(event,'content-1')" id="defaultOpen">
                <h3>Persiapan Pendaftaran Online</h3>
            </div>
            <div class="question2 tab-links" onclick="openContent(event,'content-2')">
                <h3>Prosedur  Pendaftaran Online</h3>
            </div>
            <div class="question3 tab-links" onclick="openContent(event,'content-3')">
                <h3>Cara Melihat Pengumuman</h3>
            </div>
            <div class="question4 tab-links" onclick="openContent(event,'content-4')">
                <h3>Lain - Lain</h3>
            </div>
        </div>
        <div class="accordion-container content" id="content-1">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Apa yang perlu saya siapkan untuk dapat melakukan pendaftaran secara online?
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">⦁ Sediakan waktu sekitar 30 - 45 menit untuk melakukan pengisian data.<br>
                        ⦁ Bacalah seluruh ketentuan/informasi yang terdapat pada situs-web recruitment.daihatsu.co.id<br>
                        ⦁ Siapkan softcopy foto dan berkas administrasi seperti KTP, ijazah dan transkrip nilai<br>
                        ⦁ Pastikan Anda telah menggunakan komputer dengan koneksi internet.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Spesifikasi komputer seperti apakah yang harus dipenuhi untuk dapat mengikuti pendaftaran secara online?
                    </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Apakah ada ketentuan penggunaan browser khusus untuk melakukan proses pendaftaran secara online?
                    </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Apakah ada ketentuan penggunaan browser khusus untuk melakukan proses pendaftaran secara online?
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-container content" id="content-2"> 
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Question
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.
                        </div>
                </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Question
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Question
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        Question
                    </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-container content" id="content-3">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Question
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Question
                    </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Question
                    </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        Question
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-container content" id="content-4">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Question
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Question
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Question
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Question
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae felis nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse porta commodo mi vel laoreet. Cras non odio quis enim scelerisque euismod. Nunc pharetra lacinia nisi eget ultricies. Integer quis enim interdum, tempor dui quis.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection