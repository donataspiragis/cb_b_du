{% block newCourseForm %}
<div class="container">
    <form id="newCourse" method="POST" enctype="multipart/form-data">
        <div class="container">
            {% for name, field in fields %}
                <fieldset class="{{ field.classes.fieldset }}">
                {% if field.type in ['text', 'password', 'number'] %}
                    <label class="{{ field.classes.label }}" for="{{ field.name }}">{{ field.label }}</label>
                    <input type="{{ field.type }}" id="{{ field.name }}" name="{{ field.name }}" value="{{ field.value }}">

                {% elseif field.type == 'textarea' %}
                    <label for="{{ field.name }}">{{ field.label }}</label>
                    <textarea class="w-100" id="{{ field.name }}" name="{{ field.name }}"></textarea>

                {% elseif field.type == 'checkbox' %}
                    {% for option in field.options %}
                    <div>
                        <iframe height="150" src="{{ option.value }}"></iframe>
                        <label>
                            <input type="checkbox" name="{{ name }}[{{ option.num }}][url]" value="{{ option.value }}">
                        </label>
                        <input type="number" name="{{ name }}[{{ option.num }}][order]">
                    </div>
                    {% endfor %}

                {% elseif field.type == 'date' %}
                    <label class="d-block" for="{{ field.name }}">{{ field.label }}</label>
                    <input type="date" id="{{ field.name }}" name="{{ field.name }}">

                {% elseif field.type == 'file' %}
                    <label class="d-block" for="{{ field.name }}">{{ field.label }}</label>
                    <input type="file" id="{{ field.name }}" name="{{ field.name }}">

                {% else %}

                {% endif %}
                </fieldset>
            {% endfor %}
        </div>
        <div class="container d-flex flex-row justify-content-around">
            {% for name, button in buttons %}
            <fieldset class="{{ button.classes.fieldset }}">
                <button type="submit" value="{{ button.value }}">{{ button.label }}</button>
            </fieldset>
            {% endfor %}
        </div>
    </form>
</div>
{% endblock %}