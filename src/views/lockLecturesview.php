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
        
    <form action="{{ constant('App\\App::INSTALL_FOLDER') }}/order/payexisting{{ info }}" method="post">
                    <input type="text" name="id" id="" value="{{lockcourse.ID}}" style="display: none;">
                    <input type="email" name="email" value="{{ email }}" style="display: none;">
                    <button  type="submit" class="btn-buy blue">Pirkti su 20% nuolaida</button>
                </form>
        </div>
        </div>
        <div id="overlay"></div>
    
{% endblock %}
