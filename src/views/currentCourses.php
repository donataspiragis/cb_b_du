{% extends 'userlayout.php' %}
{% block title %}Home{% endblock %}
{% block courses %}

<div class="viewCourse">
{% for course in data %}

    <div class="box">
        <div class="center">
            <div class="course-front-title">
                <h1>{{ course.name }}</h1>
            </div>
            <div class="text-view">

                <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/{{ course.picture }}" alt="">

       <!-- <h1>{{ course.name }}</h1>-->
            </div>

        <div class="simple-btn center-btn">
            <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/lecture/show/{{course.ID}}" class="btn-buy">Žiūrėti</a>
        </div>

        </div>

    </div>

{% endfor %}

    {% for lockcourse in allcourse %}


    <div class="box">
        <div class="center">
            <div class="course-front-title">
                <h1>{{ lockcourse.name }}</h1>
            </div>
            <div class="text-view">
                <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/{{ lockcourse.picture }}" alt="">
                <!-- <h1>{{ course.name }}</h1>-->
            </div>
            <div class="simple-btn center-btn">
                <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/course/buy/{{lockcourse.ID}}" class="btn-buy blue">Pirkti</a>
            </div>
        </div>
    </div>

    {% endfor %}
</div>
{% endblock %}

