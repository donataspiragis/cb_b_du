{% extends 'backlayout.php' %}
{% block title %}Home{% endblock %}
{% block datacontainer %}
{{ all.price }}

<h1>kkk</h1>

{% for in in all%}
{{ in.price }}
{% endfor %}

{% endblock %}

