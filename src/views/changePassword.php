{% extends 'frontlayout.php' %}
{% block header %}<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">{% endblock %}
{% block title %}Slaptažodžio keitimas{% endblock %}
{% block body %}
<form class="signUp-form" action="{{ constant('App\\App::INSTALL_FOLDER') }}/user/passwordStore" method="POST">
    <div class="container">
        <label for="password"><b>Naujas slaptažodis:</b></label><br>
        <input type="password" name="newPassword" class="form-control"><br>

        <label for="password2"><b>Pakartoti slaptažodį:</b></label><br>
        <input type="password" name="newPassword2" class="form-control"><br>

        <button type="submit" class="btn btn-success btn-sm" name="signUp-form">Keisti</button>
    </div>
</form>
{% endblock %}