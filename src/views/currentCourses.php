{% extends 'userlayout.php' %}
{% block title %}Home{% endblock %}
{% block courses %}

<div class="viewCourse">
{% for course in data %}

    <div class="box">
        <div class="center">
            <div class="text-view">
        <h1>{{ course.name }}</h1>
            </div>
        <div class="simple-btn center-btn">
            <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/lecture/show/{{course.ID}}" class="btn-buy">Žiūrėti</a>
        </div>
        </div>
    </div>

{% endfor %}
</div>
{% endblock %}

