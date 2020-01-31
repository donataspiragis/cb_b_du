{% extends 'backlayout.php' %}
{% block title %}Home{% endblock %}
{% block courses %}

<div class="viewCourse">
    {% for course in courses %}

    <div class="box1">
        <div class="center1">
            <div class="smallpicture">
                <img class="picture" src="{{ constant('App\\App::INSTALL_FOLDER') }}/images/{{ course.picture }}" alt="">
            </div>
            <div class="coursewindow">
                <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/course/edit/{{course.ID}}">{{ course.name }}</a>
            </div>
        </div>
    </div>
    {% endfor %}
    {% endblock %}