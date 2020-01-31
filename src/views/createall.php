{% extends 'backlayout.php' %}
{% block title %}Sukurti viską{% endblock %}
{% block datacontainer %}
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/order/createallsave" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Pavadinimas</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Pavadinimas">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Kaina</label>
                    <input type="text" name="price" class="form-control" id="exampleFormControlInput1" placeholder="Kaina">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Aprašymas</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Išsaugoti</button>
            </form>
        </div>
    </div>
</div>


{% endblock %}
