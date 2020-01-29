{% block newCourseForm %}
<div class="container">
    <form id="newCourse" method="POST" action="{{ constant('App\\App::INSTALL_FOLDER') }}/{{ action }}" enctype="multipart/form-data">
        <div class="container">
            {% for name, field in fields %}
                <fieldset class="{{ field.classes.fieldset }}">
                {% if field.type in ['text', 'password', 'number'] %}
                    <label for="{{ name }}" class="{{ field.classes.label }}">{{ field.label }}</label>
                    <input id="{{ name }}" class="{{ field.classes.input }}" type="{{ field.type }}" name="{{ name }}" placeholder="{{ field.placeholder }}" value="{{ field.value }}" {% if field.required is defined and field.required == 1 %} required {% endif %}>

                {% elseif field.type == 'textarea' %}
                    <label for="{{ name }}">{{ field.label }}</label>
                    <textarea id="{{ name }}" class="{{ field.classes.input }}" name="{{ name }}" cols="50" rows="4" {% if field.required is defined and field.required == 1 %} required {% endif %}>{{ field.value }}</textarea>

                {% elseif field.type == 'checkbox' %}
                    {% if name == 'is_active' %}
                    <input id="is_active" class="video-url-input" type="checkbox" name="{{ name }}" value="{{ field.value }}" {% if field.checked is defined and field.checked is not empty %} checked {% endif %}>
                    <div>
                        <label for="is_active" class="video-url-input-label">
                            <span class="action-label">Rodyti kursą svetainėje</span>
                            <span class="checkmark">&#10003;</span>
                        </label>
                    </div>
                    {% elseif name == 'videos_list' %}
                    <div class="container" id="newCourseVideosList">
                        {% for index, option in field.options %}
                        <div class="video-item">
                            <input class="video-url-input" id="videoUrl{{ index }}" name="{{ name }}[{{ index }}][url]" value="{{ option.value }}" type="checkbox" {% if option.checked is defined and option.checked == true %} checked {% endif %}>{{ field.value }}
                            <div class="video-item-inputs">
                                <label class="video-url-input-label" for="videoUrl{{ index }}">
                                    <span class="action-label">Pasirinkti</span>
                                    <span class="checkmark">&#10003;</span>
                                </label>
                                <div class="video-order-input-div">
                                    <label for="videoOrder{{ index }}" style="">
                                        <span>Eilės nr.:</span>
                                    </label>
                                    <input id="videoOrder{{ index }}" style="" type="number" name="{{ name }}[{{ index }}][order]" min="1" value="{{ option.order }}">
                                </div>
                            </div>
                            <iframe src="{{ option.value }}"></iframe>
                        </div>
                        {% endfor %}
                    </div>
                    {% endif %}

                {% elseif field.type == 'date' %}
                    <label for="{{ name }}" class="{{ field.classes.label }}">{{ field.label }}</label>
                    <input id="{{ name }}" class="{{ field.classes.input }}" type="date" name="{{ name }}" value="{{ field.value }}" {% if field.required is defined and field.required == 1 %} required {% endif %}>

                {% elseif field.type == 'time' %}
                <label for="{{ name }}" class="{{ field.classes.label }}">{{ field.label }}</label>
                <input id="{{ name }}" class="{{ field.classes.input }}" type="time" name="{{ name }}" value="{{ field.value }}" {% if field.required is defined and field.required == 1 %} required {% endif %}>

                {% elseif field.type == 'file' %}
                    <label class="d-block" for="">{{ field.label }}</label>
                    {% if field.value is not empty %}
                    <label id="CoverPhotoLabel" for="CoverPhotoInput" style="display: flex; align-items: center; cursor: pointer;">
                        <img id="CoverPhotoImage" src="{{ constant('App\\App::INSTALL_FOLDER') }}/images/{{ field.value }}" style="height: 100px; width: 100px; margin: 5px;" alt=""/>
                        <input type="file" style="display: none;" id="CoverPhotoInput" name="{{ name }}" value="{{ field.value }}" {% if field.required is defined and field.required == 1 %} required {% endif %} onchange="readURL(this)"/>
                        <span id="CoverPhotoSpan" style="margin: 5px;">{{ field.span }}</span>
                    </label>
                    {% endif %}
                {% else %}

                {% endif %}
                </fieldset>
            {% endfor %}
        </div>
        <div class="container d-flex flex-row justify-content-start">
            {% for name, button in buttons %}
            <fieldset class="{{ button.classes.fieldset }}">
                <button type="submit" value="{{ button.value }}">{{ button.label }}</button>
            </fieldset>
            {% endfor %}
        </div>
    </form>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#CoverPhotoImage')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100)
                    .objectFit('cover');
            };
            reader.readAsDataURL(input.files[0]);
            $('#CoverPhotoSpan').text('Įkelti kitą');
        }
    }
</script>
{% endblock %}