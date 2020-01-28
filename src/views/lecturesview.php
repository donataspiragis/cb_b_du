{% extends 'userlayout.php' %}
{% block title %}Home{% endblock %}
{% block courses %}

<div class="viewCourse">
    {% for lecture in lectures %}

    <div class="box">
        <div class="center">
            <div class="text-view">
                <h1>{{ lecture.video_url }}</h1>
            </div>
            <div class="simple-btn center-btn">
                <a href="#" class="btn-buy">Žiūrėti</a>
            </div>
        </div>
    </div>
    {% endfor %}
</div>
{% endblock %}

