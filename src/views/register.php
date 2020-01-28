{% extends 'frontlayout.php' %}
{% block title %}Registracija{% endblock %}
{% block body %}
<form class="signUp-form" action="{{ constant('App\\App::INSTALL_FOLDER') }}/user/register" method="POST">
        <div class="container">
            <label for="name"><b>Vardas:</b></label><br>
            <input type="text" name="name"  class="form-control" value="{{data.nameValue}}"><br>

            <label for="surname"><b>Pavardė:</b></label><br>
            <input type="text" name="surname"  class="form-control " value="{{data.surnameValue}}"><br>

            <label for="mail"><b>e-paštas:</b></label><br>
            <input type="email" name="email"  class="form-control" value="{{data.emailValue}}"><br>


            <label for="password"><b>Slaptažodis:</b></label><br>
            <input type="password" name="password" class="form-control" placeholder="{{data.password}}"><br>

            <label for="password2"><b>Pakartoti slaptažodį:</b></label><br>
            <input type="password" name="password2" class="form-control" placeholder="{{data.password}}"><br>

            <button type="submit" class="btn btn-success btn-sm" name="signUp-form">Registruotis</button>
        </div>
    </form>
{% endblock %}