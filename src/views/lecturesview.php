{% extends 'userlayout.php' %}
{% block title %}Home{% endblock %}
{% block courses %}

<div class="viewCourse">
    {% for lecture in lectures %}

    <div class="lecture_box">
        <div class="center">

            <div class="text-view">
                <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/tgbNymZ7vqY">
                </iframe>

            </div>
        </div>
    </div>
    {% endfor %}
</div>
{% endblock %}