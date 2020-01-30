<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ constant('App\\App::INSTALL_FOLDER') }}/css/style.css">
    <title>{% block title %}{% endblock %}</title>
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
    <div class="row" style="padding-top: 60px; width: 100%">
        <div class="col-lg-2 col-md-4 col-sm-12">
            <div class="card" >
                <div class="card-body">
                    <div id="accordion">
                        <h5 class="card-title"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"id="headingOne">Statistika</h5>
                        <ul class="nav flex-column">
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="#">Video statistika</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ constant('App\\App::INSTALL_FOLDER') }}/info/collect">Mokiniai + informacija</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ constant('App\\App::INSTALL_FOLDER') }}/order/statistics">Apyvarta</a>
                                </li>
                            </div>

                        </ul>
                        <br>
                        <h5 class="card-title"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"id="headingTwo">Video</h5>
                        <ul class="nav flex-column">
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="#">Patalpinti naują video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ constant('App\\App::INSTALL_FOLDER') }}/course/create">Sukurti naują kursą</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="#">Redaguoti esamą kursą</a>
                                </li>
                            </div>

                        </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-8 col-sm-12">
            <div class="card" style="background: linear-gradient(to bottom, #d3d3d3 0%, #f2f2f2 100%);">
                <div class="card-body">
                    {% block infocollection %}{% endblock %}

                    {% block datacontainer %}{% endblock %}
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
