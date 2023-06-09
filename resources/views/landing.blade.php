<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Swatsh</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    @livewireStyles

    <style>
        .popup {
            display: none;
            position: fixed;
            padding: 10px;
            width: 380px;
            left: 50%;
            margin-left: -150px;
            height: 500px;
            top: 25%;
            margin-top: -100px;
            background: #FFF;
            border: none;
            z-index: 20;


        }

        #popup:after {
            position: fixed;
            content: "";
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -2;
        }

        #popup:before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: #FFF;
            z-index: -1;
            border-radius: 30px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 text-dark" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/storage/images/logo.png') }}" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                SWATSH
            </a>

        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-left justify-content-left text-left">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-black font-weight-bold">TEMUKAN TEMPAT OLAHRAGA FAVORIT ANDA</h1>


                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-black-75 mb-5">Berolahraga ditempat yang membuat kamu nyaman
                        gabung dengan kami sekarang untuk dapat lebih mudah mengetahui tempat olahraga yang ada
                        disekitar anda</p>
                    {{-- <a class="btn btn-danger btn-xl" href="{{ route('mapHome') }}" onclick="show('popup')">TEMUKAN SEKARANG</a> --}}
                    <a class="btn btn-danger btn-xl" href="#" onclick="show('popup')">TEMUKAN SEKARANG</a>
                    <div class="popup rounded-2" id="popup">
                        <img src="{{ asset('/storage/images/logo.png') }}" alt="Logo" width="36" height="28" class="img-fluid mx-auto d-block mb-2">
                        <h4 class="text-black font-weight-bold ml-3mt-3 ">DAPATKAN FITUR : </h4>
                        <ul>
                            <li class="mt-4 font-weight-bold" style="color: #3730A3">Menambahkan Lokasi</li>
                            <p></p>
                            <li class="font-weight-bold" style="color: #3730A3">Bookmark Lokasi</li>
                            <p></p>
                            <li class="mb-5 font-weight-bold"style="color: #3730A3">Menambahkan Review & Melihat Review</li>
                            {{-- <p>Fitur-fitur diatas hanya bisa kamu dapatkan dengan cara melakukan registrasi akun. </p> --}}
                            <p>Setelah ini kita akan mendemokan bagaimana cara kita menampilkan data lokasinya</p>
                            <p>Apakah kamu mau?</p>
                            
                        </ul>
                        <a class="btn btn-danger btn-xl" href="#" onclick="hide('popup')">
                            < SIAP TIDAK MAU</a>
                                <a class="btn btn-secondary btn-xl mx-auto" style="color: white" href="{{ route('mapHome') }}"
                                    onclick="hide('popup')">SIAP MAU > </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>
        $ = function(id) {
            return document.getElementById(id);
        }

        var show = function(id) {
            $(id).style.display = 'block';
        }
        var hide = function(id) {
            $(id).style.display = 'none';
        }
    </script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    @livewireScripts
</body>

</html>
