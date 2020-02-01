{% extends 'frontlayout.php' %}
{% block title %}Home{% endblock %}
{% block body %}

<h2 style="margin: 20px 0; text-align: center;">Mokėjimai:</h2>

<div class="container">
    <table id="paymentsTable">
        <tr>
            <th>Pavadinimas</th>
            <th>Kaina</th>
            <th>Data</th>
            <th>Sąskaita faktūra</th>
        </tr>
        {% for index, payment in payments %}
        <tr>
            <td>{{ payment.name }}</td>
            <td>{{ payment.price }} eur</td>
            <td>{{ payment.date }}</td>
            <td style="display: flex; justify-content: space-around;">
                <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/invoice/show/{{ payment.invoice_id }}">Žiūrėti</a>
                <a href="{{ constant('App\\App::INSTALL_FOLDER') }}/invoice/show/{{ payment.invoice_id }}" download>Atsisiųsti</a>
            </td>
        </tr>
        {% endfor %}
    </table>
</div>

{% endblock %}

