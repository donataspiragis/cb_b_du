{% extends 'paylayout.php' %}
{% block title %}Buy All{% endblock %}
{% block body %}

<div class="container">
    <div class="card">

        <div class="card-body">
            <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/order/buyall/5" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">El. paštas</label>
                    <input type="email" name="email" id="" class="form-control" id="exampleFormControlInput1" placeholder="El. paštas" required>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Pradėti mokėjimą</button>
            </form>

            <div class="card">
                <h1 style="font-size: 35px;">{{ info }}</h1>
                <div class="card-body">
                <h1> {{ all.name }}</h1>
                    <p>{{ all.description }}</p>
                    <h2> {{ all.price }} EUR </h2>
                </div>
            </div>
        </div>
    </div>
</div>


{% endblock %}
