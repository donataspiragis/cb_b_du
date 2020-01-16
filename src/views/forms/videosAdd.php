{% block body %}
<br><br><br><br>
<form action="">
{% for element in lecture %}
<li><input type="checkbox"> <object width="200" height="100" data="{{element}}"></li>
</object>
{% endfor %}
    <br><br>
    <input type="submit" value="Submit">
</form>
{% endblock %}
