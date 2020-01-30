{% extends 'frontlayout.php' %}
{% block title %}Home{% endblock %}
{% block body %}
<!--Time save-->
<div id="valid_from" style="display: none;">{{ time }}</div>
<div id="valid_to" style="display: none;">{{ offer.valid_to }}</div>

<!--header - hero section-->
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
<!--header - hero section END-->
<!--Bannder start-->
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
<!--Banner END-->

<section id="video" class="front-content-holder">


    <aside class="front-aside">
        <h2>Specialūs pasiūlymai</h2>
        <p>Nuolaida kursui:</p>
        <div class="discount-one">

            <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/images/{{ discount.picture }}" alt="">
            <div class="course-discount-title">
                <h1>{{ discount.name }}</h1>
            </div>
            <button type="button" class="btn-buy open-modal" id="modal-opener" data-open="modal1">
                Peržiūrėti
            </button>

<!--            CUSTOM MODAL-->
            <div class="modal" id="modal1" data-animation="slideInOutLeft">
                <div class="modal-dialog">
                    <header class="modal-header">
                        {{ discount.name }}
                        <button class="close-modal" aria-label="close modal" data-close>
                            ✕
                        </button>
                    </header>
                    <section class="modal-content">


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
                                <span>{{ discount.about|slice(0, 40) }}
                                    <span id="dots">...</span>
                                    <span id="more"> {{ discount.about|slice(40, 2000) }}</span>
                                </span>
                                <button id="readmore">Plačiau</button>
                                <span class="original-price">{{ offer.price }} EUR</span>
                                <span class="offer-price">{{ offer.discount_offer }} EUR</span>
                                {% for course in courses %}
                                {% if offer.course_id ==  course.ID %}
                                <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/order/d_payload/{{course.ID}} ">Pirkti kursą</a>
                                {% endif%}
                                {% endfor %}
                            </div>
                        </div>
                    </section>
                </div>
            </div>


<!--            END CUSTOM MODAL-->


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





                    <p>{{ course.about|slice(0, 40) }}
                                    <span id="dots">...</span>
                                    <span id="more"> {{ course.about|slice(40, 2000) }}</span>
                                </p>
                    <button id="readmore">Plačiau</button>







                    <p>{{ course.about }}</p>
                    {% for offer in all %}
                    {% if offer.course_id ==  course.ID %}
                    <span class="coure-card-price">{{ offer.price }} EUR</span>
                    {% endif%}
                    {% endfor %}
                    <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/order/payload/{{course.ID}}" class="btn-buy">Pirkti</a>
                </div>
                <img src="{{ constant('App\\App::INSTALL_FOLDER') }}/images/{{ course.picture }}" alt="">
                <div class="course-front-title">
                    <h1>{{ course.name }}</h1>
                </div>
                <div class="course-front-about">

                    <span class="course-card-about">{{ course.about|slice(0, 28) }}</span>
                    <span class="read-description">Skaityti aprašymą</span>
                    {% for offer in all %}
                    {% if offer.course_id ==  course.ID %}
                    <span class="coure-card-price">{{ offer.price }} EUR</span>
                    {% else %}

                    {% endif%}
                    {% endfor %}
                    <div class="btn-mobile-hold">
                    <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/order/payload/{{course.ID}}" class="btn-buy btn-mobile"  id="no-disc">Pirkti</a>
                    </div>
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

