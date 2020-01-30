{% extends 'backlayout.php' %}
{% block title %}Home{% endblock %}
{% block datacontainer %}


<h1>kkk</h1>
{% for order in orders %}
{{ order.invoice_id }}
{% endfor %}
<br>
{% for invoice in invoices %}
{{ invoice.price }}
<br>
{{ invoice.created_on }}
{% endfor %}

{% endblock %}

