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

                <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/images/{{ course.picture }}" alt="">

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
                <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/images/{{ lockcourse.picture }}" alt="">
                <!-- <h1>{{ course.name }}</h1>-->
            </div>
            <div class="simple-btn center-btn">
                <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/order/payexisting{{ info }}" method="post">
                    <input type="text" name="id" id="" value="{{lockcourse.ID}}" style="display: none;">
                    <input type="email" name="email" value="{{ email }}" style="display: none;">
                    <button  type="submit" class="btn-buy blue">Pirkti</button>
                </form>
            </div>
        </div>
    </div>

    {% endfor %}
</div>
{% endblock %}

