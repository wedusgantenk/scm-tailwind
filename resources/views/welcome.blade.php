<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CV. Marvelindo Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="icon" href="{{asset('assets/image/MV 1.png')}}" type="image/x-icon" />

    <style>
        body {
            background: url("./assets/image/New.png") no-repeat;
            background-size: cover;
        }

        .highlight {
            color: purple;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/image/MV 1.png')}}" width="100px" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="font-size: 25px">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a style="color: purple" class="nav-link" href="Fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#showcase">Showcase</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimoni">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard')}}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content goes here -->
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <h1 style="font-size: 50px">
                    Menjadi Produk Andalan <span class="highlight">Bagi Anda</span>
                </h1>
                <br />
                <p style="font-size: 35px; color: grey">
                    CV Marvelindo Utama berkomitmen
                    <br />dalam menghargai konsumen sebagai partnership kami. Ayo dapatkan 
                    <br />aplikasinya dibawah ini.
                </p>
                <br />
                <img src="{{asset('assets/image/Apple.png')}}" width="200px" alt="" style="margin-right: 10px" />
                <img src="{{asset('assets/image/Google.png')}}" width="200px" alt="" />
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6" style="margin-top: 550px">
                <img src="{{asset('assets/image/Counter.png')}}" width="1300px" alt="" />
            </div>
        </div>
    </div>
    <div class="fitur container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6" style="margin-top: 300px">
                <img src="{{asset('assets/image/How It Works.png')}}" width="1300px" alt="" style="margin-left: 10px" />
            </div>
        </div>
    </div>
    <div class="testimoni container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6" style="margin-top: 300px">
                <img src="{{asset('assets/image/Testimonial.png')}}" width="900px" alt="" style="margin-left: 200px" />
            </div>
        </div>
    </div>
    <div class="faq container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6" style="margin-top: 300px">
                <img src="{{asset('assets/image/FAQ.png')}}" width="1400px" alt="" />
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6" style="margin-top: 300px">
                <img src="{{asset('assets/image/Latest News.png')}}" width="1300px" alt="" />
            </div>
        </div>
    </div>
    <div class="kontak container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6" style="margin-top: 300px">
                <img src="{{asset('assets/image/footer.png')}}" width="1300px" alt="" />
            </div>
        </div>
    </div>
    <br />
    <br />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>