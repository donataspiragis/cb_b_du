{% block newCourseForm %}
<div class="container">
    <form id="newCourse" method="POST" enctype="multipart/form-data">
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
                    <input id="is_active" class="video-url-input" type="checkbox" name="{{ name }}" value="{{ field.value }}">
                    <div>
                        <label for="is_active" class="video-url-input-label">
                            <span class="action-label">{{ field.label }}</span>
                            <span class="checkmark">&#10003;</span>
                        </label>
                    </div>
                    {% elseif name == 'videos_list' %}
                    <div class="container" id="newCourseVideosList">
                        {% for option in field.options %}
                        <div class="video-item">
                            <input class="video-url-input" id="videoUrl{{ option.num }}" name="{{ name }}[{{ option.num }}][url]" value="{{ option.value }}" type="checkbox">
                            <div class="video-item-inputs">
                                <label class="video-url-input-label" for="videoUrl{{ option.num }}">
                                    <span class="action-label">Pasirinkti šitą</span>
                                    <span class="checkmark">&#10003;</span>
                                </label>
                                <div class="video-order-input-div">
                                    <label for="videoOrder{{ option.num }}" style="">
                                        <span>Eilės nr.:</span>
                                    </label>
                                    <input id="videoOrder{{ option.num }}" style="" type="number" name="{{ name }}[{{ option.num }}][order]" min="1">
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
                    <input type="file" id="" name="{{ name }}" {% if field.required is defined and field.required == 1 %} required {% endif %}>

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
{% endblock %}