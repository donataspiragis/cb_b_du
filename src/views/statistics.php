{% extends 'backlayout.php' %}
{% block title %}Home{% endblock %}
{% block datacontainer %}
<!--{{ all.price }}

<h1>kkk</h1>

{% for in in all%}
{{ in.price }}
{% endfor %}-->

<div class="viewCourse">
    <div class="statistic">
        <div class="boxcenter">
            <h1>Einamas mėnuo <br>{{amount.thisMonth}}</h1>
        </div>
    </div>
    <div class="statistic">
        <div class="boxcenter">
            <h1>Einami metai <br>{{amount.thisYear}}</h1>
        </div>
    </div>
    <div class="statistic">
        <div class="boxcenter">
            <h1>Ketvirtis <br>{{amount.thisQuarter}}</h1>
        </div>
    </div>
    <div class="statistic">
        <div class="boxcenter">
            <h1>Pusmetis <br>{{amount.halfYear}}</h1>
        </div>
    </div>
</div>



{% endblock %}
