{% extends 'userlayout.php' %}
{% block title %}Home{% endblock %}
{% block courses %}


<div class="viewCourse">

    {% for lecture in lectures %}

    <div class="lecture_box">
        <div class="center">

            <div class="text-view">
            <img style = "width:100%; height:100%;" src="http://img.youtube.com/vi/tgbNymZ7vqY/sddefault.jpg" alt="">
            

            </div>
        </div>
    </div>
    {% endfor %}
    
    </div>
    <div class="pirk">
    <h1>Esate lojalus vartotojas, tad suteiksime nuolaidą.</h1>
    <div class="center-btn">
        
            <a href="{{ constant('App\\App::INSTALL_FOLDER') }}" style = "height:50px;"class="btn-buy blue">Pirk su 20% nuolaida</a>
        </div>
        </div>
        <div id="overlay"></div>
    
{% endblock %}