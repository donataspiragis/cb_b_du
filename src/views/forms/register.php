<!--{% block register%}-->
<div class="container">
    <form action="" method="post">
        <div class="container">
            <label for="name"><b>Įveskite vardą:</b></label>
            <input type="text" name="name" placeholder="vardas">
            <label for="surname"><b>Įveskite pavardę:</b></label>
            <input type="text" name="surname" placeholder="pavardė">
            <label for="mail"><b>Įveskite elektroninio pašto adresą:</b></label>
            <input type="email" name="mail" placeholder="e-paštas">
            <label for="mailRepeat"><b>Įveskite elektroninio pašto adresą dar kartą:</b></label>
            <input type="email" name="mailRepeat" placeholder="e-pasštas">
            <label for="password"><b>Įveskite slaptažodį:</b></label>
            <input type="password" name="password" placeholder="slaptažodis">
            <label for="password2"><b>Įveskite slaptažodį dar kartą:</b></label>
            <input type="password" name="password2" placeholder="slaptažodis">
            <button type="submit" name="login-submit">Registruotis</button>
        </div>
    </form>
    <!--{% endblock %}-->