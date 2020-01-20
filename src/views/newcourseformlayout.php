

{% block newCourseForm %}
<div class="container">
    <form id="newCourse" method="POST" enctype="multipart/form-data">
        <div class="container">
            {% for field in fields %}
                <fieldset class="{{ field.classes.fieldset }}">
                {% if field.type in ['text', 'password', 'number'] %}
                    <label class="{{ field.classes.label }}" for="{{ field.id }}">{{ field.label }}</label>
                    <input type="{{ field.type }}" id="{{ field.id }}" name="{{ field.name }}">
                {% elseif field.type == 'textarea' %}
                    <label for="{{ field.id }}">{{ field.label }}</label>
                    <textarea class="w-100" id="{{ field.id }}" name="{{ field.name }}"></textarea>
                {% elseif field.type == 'checkbox' %}
                    {% for option in field.options %}
                        <label class="d-flex flex-row align-items-center">
                            <input type="checkbox" name="{{field.name}}[]" value="{{ option.value }}">
                            <span class="pl-2">{{ option.label }}</span>
                        </label>
                    {% endfor %}
                {% elseif field.type == 'date' %}
                    <label class="d-block" for="{{ field.id }}">{{ field.label }}</label>
                    <input type="date" id="{{ field.id }}" name="{{ field.name }}">
                {% elseif field.type == 'file' %}
                    <label class="d-block" for="{{ field.id }}">{{ field.label }}</label>
                    <input type="file" id="{{ field.id }}" name="{{ field.name }}">
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