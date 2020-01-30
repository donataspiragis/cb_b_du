{% extends 'paylayout.php' %}
{% block title %}Home{% endblock %}
{% block body %}



<div class="container">
    <div class="card">

        <div class="card-body" style="text-align: center;">
           <h1>Atsiprašome bet mokėjimas atmestas</h1>
            <br>
            <p>Tikimės jog nenutiko nieko blogo ir sugrįšite pas mus!</p>
            <br>
            <h3>Kol kas peržiūrėkite ką galime pasiūlyti!</h3>
            <br>
            <a href="{{ constant('App\\App::INSTALL_FOLDER') }}" class="btn-buy">Peržiūrėti</a>

        </div>
    </div>
</div>

{% endblock %}