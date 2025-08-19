    <!DOCTYPE html>
    <html lang="en-US" dir="ltr">

    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI MANTAP || APPS</title>
    <link rel="apple-touch-icon" sizes="180x180" href="lanpage/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="lanpage/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="lanpage/assets/img/logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="lanpage/assets/img/logo.png">
    <link rel="manifest" href="lanpage/assets/img/logo.png">
    <meta name="msapplication-TileImage" content="lanpage/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link href="lanpage/assets/css/theme.css" rel="stylesheet" />

    </head>


    <body>

    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" target="_blank" href=""><img src="lanpage/assets/img/logo.png" height="71" alt="logo" /> <b style="margin-left: 10px;">SI MANTAP
            </b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="">Home</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#profile">Profile</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#proyek">Proyek</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#panduan">Panduan</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#alamat">Alamat</a></li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="
                                @if(auth()->user()->role === 'admin')
                                    {{ route('dashboard-admin') }}
                                @elseif(auth()->user()->role === 'pengawas')
                                    {{ route('dashboard-pengawas') }}
                                @elseif(auth()->user()->role === 'tender')
                                    {{ route('dashboard-tender') }}
                                @else
                                    #
                                @endif
                                ">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>    @else
                    <li class="nav-item"><a class="nav-link btn btn-primary" aria-current="page" href="{{ route('login') }}">Login/Registrasi</a></li>
                @endauth
                
            </ul>
            </div>
        </div>
        </nav>

        <section class="pt-7">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center py-6">
                <h1 class="mb-4 fs-9 fw-bold">Welcome!</h1>
                <p class="mb-6 lead text-secondary">Sistem Monitoring, Koordinasi Terpadu Dan Profesional.<br class="d-none d-xl-block" />Pengawasan Cerdas Layanan Mantap.</p>
                <div class="text-center text-md-start"><a class="btn btn-warning me-3 btn-lg" href="#profile" role="button">Selengkapnya</a>
                <a class="btn btn-link text-warning fw-medium" href="#!" role="button" data-bs-toggle="modal" data-bs-target="#popupVideo"><span class="fas fa-play me-2"></span>Watch the video </a>
                </div>
            </div>
            <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid" src="lanpage/assets/img/logo.png" alt="" /></div>
            </div>
        </div>
        </section>
        <section class="pt-5" id="profile">

        <div class="container">
            <div class="row">
            <div class="col-lg-6">
                <h2 class="mb-2 fs-7 fw-bold">Tentang Kami</h2>
                <p class="mb-4 fw-medium text-secondary">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam iure illum repellendus veritatis recusandae quibusdam repudiandae, pariatur ex? Saepe ad optio cupiditate numquam dolores beatae illo distinctio velit magnam qui!
                </p>
            </div>
            <div class="col-lg-6"><img class="img-fluid" src="lanpage/assets/img/kantor.jpg" alt="" /></div>
            </div>
        </div>

        </section>
        <section class="pt-5" id="layanan">

        <div class="container">
            <div class="row">
            <div class="col-lg-6"><img class="img-fluid" src="assets/img/manager/manager.png" alt="" /></div>
            <div class="col-lg-6">
                <h5 class="text-secondary">Kami Melayani !</h5>
                <p class="fs-7 fw-bold mb-2">Pelayanan ?</p>
                <div class="d-flex align-items-center mb-3"> <img class="me-sm-4 me-2" src="lanpage/assets/img/manager/tick.png" width="35" alt="tick" />
                <p class="fw-medium mb-0 text-secondary">Koordinasi</p>
                </div>
                <div class="d-flex align-items-center mb-3"> <img class="me-sm-4 me-2" src="lanpage/assets/img/manager/tick.png" width="35" alt="tick" />
                <p class="fw-medium mb-0 text-secondary">Pengawasan</p>
                </div>
            </div>
            </div>
        </div>

        </section>

                <!-- SECTION PROYEK -->
        <section class="pt-5" id="proyek">
        <div class="container">
            <h2 class="mb-4 text-center fs-7 fw-bold">Proyek Terbaru</h2>
            <div class="row">
                    @foreach($proyek as $row)
                        <div class="col-md-4 mt-3">
                            <div class="card shadow-sm p-3">
                            <img src="{{ asset('storage/' . $row->gambar) }}" class="card-img-top" alt="{{ $row->nameProyek }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $row->nameProyek}}</h5>
                                <h6 class="card-text">{{ 'Rp ' . number_format($row->nilai, 0, ',', '.') }}</h6>    <h6 class="card-text">{{ $row->lokasi }}</h6>
                                <a href="" class="btn btn-primary btn-sm">Detail Proyek</a>
                            </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
        </section>

        <!-- SECTION PANDUAN -->
        <section class="pt-5" id="panduan">
        <div class="container">
            <h2 class="mb-4 text-center fs-7 fw-bold">Panduan Penggunaan</h2>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">1. Login atau registrasi melalui tombol di kanan atas</li>
            <li class="list-group-item">2. Masukkan data sesuai form yang tersedia</li>
            <li class="list-group-item">3. Gunakan fitur monitoring sesuai kebutuhan Anda</li>
            </ul>
        </div>
        </section>

        <!-- SECTION TESTIMONI -->
        <section class="pt-5 bg-light">
        <div class="container">
            <h2 class="mb-4 text-center fs-7 fw-bold">Apa Kata Mereka</h2>
            <div class="row">
            <div class="col-md-6">
                <blockquote class="blockquote">
                <p>"Sangat membantu kami di desa untuk melaporkan kegiatan bulanan secara online."</p>
                <footer class="blockquote-footer">Bpk. Markus - Kepala Desa</footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote">
                <p>"Kini lebih mudah memantau data gizi anak tanpa perlu bolak-balik ke kantor."</p>
                <footer class="blockquote-footer">Ibu Yuliana - Kader Posyandu</footer>
                </blockquote>
            </div>
            </div>
        </div>
        </section>

        <!-- SECTION FAQ -->
        <section class="pt-5" id="faq">
        <div class="container">
            <h2 class="mb-4 text-center fs-7 fw-bold">Pertanyaan yang Sering Ditanyakan</h2>
            <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1Collapse">
                    Apakah aplikasi ini gratis?
                </button>
                </h2>
                <div id="faq1Collapse" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ya, aplikasi ini sepenuhnya gratis untuk digunakan oleh semua kader dan petugas lapangan.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2Collapse">
                    Bagaimana cara menghubungi admin jika mengalami masalah?
                </button>
                </h2>
                <div id="faq2Collapse" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Anda bisa menghubungi kami melalui form di bawah atau email resmi kami.
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- SECTION HUBUNGI KAMI -->
        <section class="pt-5" id="hubungi">
        <div class="container">
            <h2 class="mb-4 text-center fs-7 fw-bold">Hubungi Kami</h2>
            <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                <input type="text" class="form-control" placeholder="Nama Lengkap">
                </div>
                <div class="col-md-6 mb-3">
                <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="col-12 mb-3">
                <textarea class="form-control" rows="4" placeholder="Pesan Anda..."></textarea>
                </div>
                <div class="col-12 text-center">
                <button class="btn btn-primary" type="submit">Kirim Pesan</button>
                </div>
            </div>
            </form>
        </div>
        </section>



    <section class="pt-5" id="alamat">

        <div class="container">
            <div class="row">
            <div class="col-lg-6">
                <h2 class="mb-2 fs-7 fw-bold">Alamat - Nusa Tenggara Timur</h2>
                <p class="mb-4 fw-medium text-secondary">
                Jl. Unnamed Road Oelamasi, Naibonat, Kec. Kupang Tim., Kabupaten Kupang, Nusa Tenggara Timur <br>
            Telepon: Telp (0380) 831321 <br>
            Email: 
                </p>
            </div>
            <div class="col-lg-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.2627711734212!2d123.8701451756771!3d-10.077542190031865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569c82808b9801%3A0x92e632cd2d047c6e!2sKantor%20Bupati%20Kupang!5e0!3m2!1sid!2sid!4v1755613629224!5m2!1sid!2sid" 
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            </div>
        </div>

        </section>
        <section class="text-center py-0">

        <div class="container">
            <div class="container border-top py-3">
            <div class="row justify-content-between">
                <div class="col-12 col-md-auto mb-1 mb-md-0">
                <p class="mb-0">&copy; <?= date("Y");?> Power By Nbxx </p>
                </div>
            </div>
            </div>
        </div>

        </section>


    </main>
    <div class="modal fade" id="popupVideo" tabindex="-1" aria-labelledby="popupVideo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <iframe class="rounded" style="width:100%;height:500px;" src="https://www.youtube.com/embed/mh2sIAJ1Pls?si=_EZiXklldi4WhJcB" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        </div>
    </div>
    <script src="lanpage/vendors/@popperjs/popper.min.js"></script>
    <script src="lanpage/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="lanpage/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="lanpage/vendors/fontawesome/all.min.js"></script>
    <script src="lanpage/assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
    </body>

    </html>