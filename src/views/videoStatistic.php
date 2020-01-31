{% extends 'backlayout.php' %}
{% block header %}<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">{% endblock %}
{% block title %}Video{% endblock %}
{% block datacontainer %}
​
<div class="container">
    {% for video in videos %}
    <div>
        <iframe width="300" height="150" src="{{video.videos}}"></iframe>
        <br>
        <b>Likes: {{video.likeCount}}</b>
        <br>
        <b>Dislikes: {{video.dislikeCount}}</b>
        <br>
        <b>Comments: {{video.commentCount}}</b>
    </div>
    {% endfor %}
</div>
{% endblock %}