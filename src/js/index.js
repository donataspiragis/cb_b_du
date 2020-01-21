


var to = document.querySelector('#valid_to');
var from = document.querySelector('#valid_from');
$( document ).ready(function() {
    to = jQuery(to).text()
    from = jQuery(from).text();

    var countDownDate =  new Date(to).getTime() ;
    var now = new Date(from).getTime();
    var x = setInterval(function() {
        now = now + 1000;
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timer").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "Deja pasiūlymo laikas baigėsi";
        }
    }, 1000);

});

