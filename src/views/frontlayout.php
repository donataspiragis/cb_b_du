<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ constant('App\\App::INSTALL_FOLDER') }}/css/style.css">
    {% block header %}{% endblock %}
    <title>{% block title %}{% endblock %}</title>
    <style>
        #paymentsTable {
            width: 75%;
            max-width: 800px;
            margin: 10px auto;
        }

        #paymentsTable th {
            text-align: left;
            padding: 10px 10px 10px 20px;
        }

        #paymentsTable td {
            text-align: left;
            padding: 5px 5px 5px 10px;
        }

        #paymentsTable tr:nth-of-type(odd){
            background-color: silver;
        }

        #paymentsTable tr:nth-of-type(even){
            background-color: #e8e8e8;
        }
    </style>
</head>
<body>

<nav class="nav-customize" id="sticker">
    <div class="nav-container">
        <a class="navbar-brand-c" href="{{ constant('App\\App::INSTALL_FOLDER') }}/">CB_B_DU mokykis</a>
        <div class="navbar-content">
            <a href="javascript:void(0);" class="icon" id="icon">
                <i class="fa fa-bars"></i>
            </a>
            <ul class="navbar-nav-auto navbar-nav-display" id="navhold">
                <li class="nav-link-cust">
                    <a class="" href="{{ constant('App\\App::INSTALL_FOLDER') }}/">Pradinis</a>
                </li>
                <li class="nav-link-cust">
                    <button type="button"  class="open-modal" data-open="modal2">
                        Prisijungti
                    </button>
                </li
            </ul>
        </div>
    </div>

</nav>
<!-- Modal -->
<div class="modal modal-cust" id="modal2" data-animation="slideInOutTop">
    <div class="modal-dialog modal-dialog-login">
        <header class="modal-header">
            Prisijungti
            <button class="close-modal" aria-label="close modal" data-close>
                ✕
            </button>
        </header>
        <section class="modal-content">
            <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/user/login" method="post">
                <input type="text" name="email" placeholder="El. paštas">
                <input type="password" name="password" placeholder="Slaptažodis">
                <button  type="submit" class="btn-buy" data-dismiss="modal">Prisijungti</button>
            </form>
        </section>
    </div>
</div>
{% block body %}{% endblock %}

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
