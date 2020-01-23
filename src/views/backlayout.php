<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ constant('App\\App::INSTALL_FOLDER') }}/css/style.css">
    <title>{% block title %}{% endblock %}</title>

    <style>
        input, textarea {
            border: 1px solid transparent;
        }

        #newCourseVideosList {
            padding: 5px;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            background-color: ;
        }

        .video-item {
            width: 30%;
            margin: 5px;
            display: flex;
            flex-direction: column;
            background-color: ;
        }

        .video-url-input {
            display: none;
        }

        .video-item-inputs {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            background-color: ;
        }

        .video-url-input-label {
            cursor: pointer;
            white-space: nowrap;
            margin: 5px;
            padding: 5px;
            border: none;
            border-radius: 5px;
            background-color: ;
        }

        .video-url-input-label span {
            margin-right: 5px;
        }

        span.checkmark {
            font-weight: bold;
            background-color: white;
            color: white;
            border-radius: 5px;
            padding: 2px;
        }

        span.action-label {
            padding: 5px;
            border-radius: 5px;
        }

        span.action-label:hover {
            background-color: green;
            color: gold;
        }

        input.video-url-input:checked + div > label span.action-label {
            color: gold;
        }

        .video-order-input-div {
            visibility: hidden;
        }

        input.video-url-input:checked + div > label span.checkmark {
            color: green;
        }

        input.video-url-input:checked + div > label {
            color: gold;
            background-color: green;
        }

        input.video-url-input:checked + div > div {
            visibility: visible;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number]:fo {
            -moz-appearance:textfield;
        }

        .video-order-input-div input {
            color: green;
            border: 1px solid green;
            text-align: center;
            width: 30px;
            outline: none;
            margin: 5px;
            padding: 3px;
            background-color: ;
            border-radius: 5px;
        }

        .video-order-input-div label {
            padding: 2px 5px;
            border-radius: 5px;
        }

        .video-order-input-div label:hover {
            color: gold;
            background-color: green;
        }

        .video-item iframe {
            width: 100%;
            border: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ constant('App\\App::INSTALL_FOLDER') }}/">CB_B_DU mokykis</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ constant('App\\App::INSTALL_FOLDER') }}/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ constant('App\\App::INSTALL_FOLDER') }}/auth/logof">Atsijungti</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ constant('App\\App::INSTALL_FOLDER') }}/auth/profile">Profilis</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<main class="d-flex p-2 bd-highlight justify-content-center">
    <div class="row" style="padding-top: 60px;">
        <div class="col-lg-2 col-md-4 col-sm-12">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Statistika</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Video statistika</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Mokiniai + informacija</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Apyvarta</a>
                        </li>
                    </ul>
                    <br>
                    <h5 class="card-title">Video</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Patalpinti naują video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Sukurti naują kursą</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">Redaguoti esamą kursą</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-8 col-sm-12">
            <div class="card" style="background: linear-gradient(to bottom, #d3d3d3 0%, #f2f2f2 100%);">
                <div class="card-body">
                    {{ newCourseForm }}
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <div class="text-muted" style="text-align: center; width: 100%;font-size: 1.2rem;">Copyright @ CB_B_DU Projektas</div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
