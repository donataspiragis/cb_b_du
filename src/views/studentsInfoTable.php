{% extends 'backlayout.php' %}
{% block title %}Home{% endblock %}
{% block infocollection %}

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width:90%;
            margin: auto;
            overflow: auto;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }
        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }
        table#t01 th {
            background-color: black;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>

<table id="t01">
    <tr>
        <th>Vartotojas</th>
        <th>Elektroninis paštas</th>
        <th>Įsigijo kursą</th>
        <th>Paskutinis apsilankymas</th>
        <th>Susisiekti</th>
    </tr>
    {% for user in  users %}
    <tr>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>
            {% for courses in  coursename %}
            {{ courses.name }},
            {% endfor %}
        </td>
        <td>{{ user.last_log }}</td>
        <td><button onclick="myFunction()">Išsiusti laišką</button></td>
    </tr>
    {% endfor %}

</table>

</body>
</html>

{% endblock %}