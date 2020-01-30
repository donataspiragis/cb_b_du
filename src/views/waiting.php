{% extends 'paylayout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<div class="container">
    <div class="card">
        <div class="card-body">
            <p>{{ info }}</p>
            <p>Išsiuntėme tau ir laiška, kai patvritintas bus mokėjimas, galėsi prisijungti. O kol kas pasižiūrėk ar nėra ko dar norėtum: </p>
            <a href="{{ constant('App\\App::INSTALL_FOLDER') }}" class="btn-buy">Peržiūrėti</a>
        </div>
    </div>
</div>
{% endblock %}