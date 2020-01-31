<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ constant('App\\App::INSTALL_FOLDER') }}/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

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
                    <a class="nav-link" href="{{ constant('App\\App::INSTALL_FOLDER') }}/user/logout">Atsijungti</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ constant('App\\App::INSTALL_FOLDER') }}/auth/profile">Profilis</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<main class="d-flex p-2 bd-highlight justify-content-center">
<input type="text" name="id" id="getval" value="{{value}}" style="display: none;">
<input type="text" name="id" id="getval2" value="{{menu}}" style="display: none;">
    <div class="row" style="padding-top: 60px;width: 100%">
        <div class="col-lg-2 col-md-4 col-sm-12">
            <div class="card" >
                <div class="card-body">
                    <div id="accordion">
                    <h5 class="card-title"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"id="headingTwo">Video pamokos</h5>
                    <ul class="nav flex-column">
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        {% for course in data|slice (0,4) %}
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="id{{course.ID}}" href="{{ constant('App\\App::INSTALL_FOLDER') }}/lecture/show/{{course.ID}}"><i class="fas fa-lock-open"style="transform: scaleX(-1);" aria-hidden="true"></i> {{course.name}}</a>
                        </li>
                        {% endfor %}
                        {% for lockcourse in allcourse|slice (0,5) %}
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="id{{lockcourse.ID}}"href="{{ constant('App\\App::INSTALL_FOLDER') }}/lecture/show/{{lockcourse.ID}}"><i class="fa fa-lock" aria-hidden="true"></i> {{lockcourse.name}}</a>
                        </li>
                        {% endfor %}
                            <li class="nav-item">
                            <a class="nav-link text-dark" id="allcourse"href="{{ constant('App\\App::INSTALL_FOLDER') }}/course/display">VisosPamokos</a>
                            </li>
                        </div>

                    </ul>
                    <br>

                                        <h5 class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"id="headingOne">
                                            Asmeninė informacija<!--  <a class="nav-link text-dark" href="#">Pakeisti slaptažodį</a>-->
                                        </h5>
                            <ul class="nav flex-column">
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" id="changepass"href="{{ constant('App\\App::INSTALL_FOLDER') }}/user/changePassword">Pakeisti slaptažodį</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" id="myinfo"href="{{ constant('App\\App::INSTALL_FOLDER') }}/invoice/index">Mano informacija</a>
                                    </li>
                                </div>


                    </ul>
                    <br>
                    <a class="card-title h5 text-dark" href="#">Naujienos</a>
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-8 col-sm-12">
            <div class="card" style="background: linear-gradient(to bottom, #d3d3d3 0%, #f2f2f2 100%);">
                <div class="card-body">
                    {% block courses %}

                    {% endblock %}
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
<script src="{{ constant('App\\App::INSTALL_FOLDER') }}/js/main.js" defer></script>
</body>

</html>



