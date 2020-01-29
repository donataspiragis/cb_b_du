{% extends 'paylayout.php' %}
{% block title %}Home{% endblock %}
{% block body %}



<div class="container">
    <div class="card">

        <div class="card-body">
            {{ data }}
            <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/order/checkPrePayment/{{ id }}" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">El. paštas</label>
                    <input type="email" name="email" id="" class="form-control" id="exampleFormControlInput1" placeholder="El. paštas">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Pradėti mokėjimą</button>
            </form>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ offer.name}}</h5>
                    <p class="card-text">    {{ offer.about }}</p>
                    {{ amount }}
                </div>
            </div>

        </div>
    </div>
</div>

{% endblock %}