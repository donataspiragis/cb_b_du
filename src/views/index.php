{% extends 'frontlayout.php' %}
{% block title %}Home{% endblock %}
{% block body %}

<div id="valid_from" style="display: none;">{{ time }}</div>
<div id="valid_to" style="display: none;">{{ offer.valid_to }}</div>

<div class="front-header-section">
    <div class="front-header-content">
        <h1>CB_B_DU E-Mokymasis</h1>
        <h2>Mokytis gali būti smagu!</h2>
        <p>
            Įvairūs video skirti Jūsų mokslams. Šių video dėka Jūs galėsit išmokti nuo nulio arba pasitobulinti jau turimas žinias.
        </p>
        <a href="#video">Peržiūrėk</a>
    </div>
</div>

<section class="banner">
    <div>
        <div class="banner-font-awsemoe">
            <i class="fas fa-infinity"></i>
            <div>
                <h3>"Neribotas kiekis"</h3>
                <p>
                    Gerų kursų daugybė, kad pagalvosi jog jie nesibaigia.
                </p>
            </div>
        </div>

        <div class="banner-font-awsemoe">
            <i class="fas fa-school"></i>
            <div>
                <h3>Mokytojai ekspertai</h3>
                <p>
                    Kursai vedami mokytojų turinčių didžiulę patirtį savo srityje ir dėstyme.
                </p>
            </div>
        </div>

        <div class="banner-font-awsemoe">
            <i class="fas fa-laptop-medical"></i>
            <div>
                <h3>Mokykis betkur</h3>
                <p>
                    Neprisirišk prie įrenginio ir mokykis bet kur ir bet kada.
                </p>
            </div>
        </div>
    </div>
</section>


<section id="video" class="front-content-holder">

    <aside class="front-aside">
        <h2>Specialūs pasiūlymai</h2>
        <p>Nuolaida kursui:</p>
        <div class="discount-one">
            {% for discount in discount %}
            <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/{{ discount.picture }}" alt="">
            <div class="course-discount-title">
                <h1>{{ discount.name }}</h1>
            </div>
            <button type="button" class="btn-buy" data-toggle="modal" data-target="#exampleModalCenter">
                Pasižiūrėti
            </button>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ discount.name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-bod-custom">
                                <div class="discount-pop-left">
                                    <div>
                                        <h1>{{ discount.name }}</h1>
                                        <p>

                                            ({{ offer.valid_from|slice(0,10) }}
                                        -
                                        {{ offer.valid_to|slice(0,10) }})

                                        </p>
                                    </div>
                                </div>
                                <div class="modal-bod-content">

                                   <p>Pasiūlymas galioja iki: <span id="timer"></span> </p>
                                    <h2>Kurso aprašymas:</h2>
                                    <span>{{ discount.about }}</span>
                                    <span class="original-price">{{ offer.price }} EUR</span>
                                    <span class="offer-price">{{ offer.discount_offer }} EUR</span>

                                    <a href="#">Pirkti kursą</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Nenoriu pasiūlymo</button>
                        </div>
                    </div>
                </div>
            </div>
            {% endfor %}
            <div></div>
            <h2>Super akcija visam paketui:</h2>
            <div class="buy-all-container">
                <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/buyall/all" class="btn-buy-me">PIRK VISKA</a>
            </div>
    </aside>
    <div>
        <h1 class="section-heading">Visi kursai</h1>
        <div class="front-video-container">

            {% for course in courses %}
            <div class="course-front">
                <div class="tooler">
                    <h1>{{ course.name }}</h1>
                    <p>{{ course.about }}</p>
                    {% for offer in all %}
                    {% if offer.course_id ==  course.ID %}
                    <span class="coure-card-price">{{ offer.price }} EUR</span>
                    {% endif%}
                    {% endfor %}
                    <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/offer/index" class="btn-buy">Pirkti</a>
                </div>
                <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/{{ course.picture }}" alt="">
                <div class="course-front-title">
                    <h1>{{ course.name }}</h1>
                </div>
                <div class="course-front-about">
                    {{ course.about|slice(0, 60) }}

                    {% for offer in all %}
                    {% if offer.course_id ==  course.ID %}
                    <span class="coure-card-price">{{ offer.price }} EUR</span>
                    {% endif%}
                    {% endfor %}

                </div>
            </div>
            {% endfor %}
        </div>
        <div class="showall-btn">
            <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/front/showall" class="btn-buy">Visos pamokos</a>
        </div>
    </div>

</section>
{% endblock %}

