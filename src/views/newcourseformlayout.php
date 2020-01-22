{% block newCourseForm %}
<div class="container">
    <form id="newCourse" method="POST" enctype="multipart/form-data">
        <div class="container">
            {% for name, field in fields %}
                <fieldset class="{{ field.classes.fieldset }}">
                {% if field.type in ['text', 'password', 'number'] %}
                    <label class="{{ field.classes.label }}" for="">{{ field.label }}</label>
                    <input type="{{ field.type }}" id="" name="{{ name }}" value="{{ field.value }}">

                {% elseif field.type == 'textarea' %}
                    <label for="">{{ field.label }}</label>
                    <textarea class="w-100" id="" name="{{ name }}">{{ field.value }}</textarea>

                {% elseif field.type == 'checkbox' %}
                    {% if name == 'is_active' %}
                    <label>
                        <input type="checkbox" name="{{ name }}" value="{{ field.value }}">
                        <span>{{ field.label }}</span>
                    </label>
                    {% elseif name == 'videos_list' %}
                    <div class="container" style="width: 350px; background-color: ">
                        {% for option in field.options %}
                        <div style="width: 100%; background-color: ; margin: 5px; padding: 5px; display: flex; flex-wrap: wrap; justify-content: flex-start;">
                            <iframe style="display: block; margin-bottom: 5px;" height="150" src="{{ option.value }}"></iframe>
                            <label style="margin-right: 10px;">
                                <input style="" type="checkbox" name="{{ name }}[{{ option.num }}][url]" value="{{ option.value }}">
                            </label>
                            <span style=""> - select and order - </span>
                            <input style="width: 40px; margin-left: 10px;" type="number" name="{{ name }}[{{ option.num }}][order]">
                        </div>
                        {% endfor %}
                    </div>
                    {% endif %}

                {% elseif field.type == 'date' %}
                    <label class="d-block" for="">{{ field.label }}</label>
                    <input type="date" id="" name="{{ name }}">

                {% elseif field.type == 'file' %}
                    <label class="d-block" for="">{{ field.label }}</label>
                    <input type="file" id="" name="{{ name }}">

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