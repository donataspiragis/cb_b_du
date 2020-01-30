var to = document.querySelector('#valid_to');
var from = document.querySelector('#valid_from');
$( document ).ready(function() {
    $('#modal-opener').on('click', function (){
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
            document.getElementById("timer").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Deja pasiūlymo laikas baigėsi";
            }
        }, 1000);
    })
});

const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible";

for (const el of openEls) {
    el.addEventListener("click", function() {
        const modalId = this.dataset.open;
        document.getElementById(modalId).classList.add(isVisible);
    });
}

for (const el of closeEls) {
    el.addEventListener("click", function() {
        this.parentElement.parentElement.parentElement.classList.remove(isVisible);
    });
}

document.addEventListener("click", e => {
    if (e.target == document.querySelector(".modal.is-visible")) {
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
    }
});

document.addEventListener("keyup", e => {
    // if we press the ESC
    if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
    }
});


$('#icon').on('click', function(){
    $('#navhold').toggleClass('navbar-nav-display');
    $('#navhold').toggleClass('responsiveul', 2000);
});

var header = document.getElementById("sticker");
var sticky = header.offsetTop;
function stickToTop() {
    if (window.pageYOffset > sticky ) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

window.onscroll = function() {stickToTop()};


$('#readmore').on('click', function(){
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("readmore");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Plačiau";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Sumažinti";
        moreText.style.display = "inline";
        console.log('sudas');
    }
});

$('#remind-me').on('click', function(){
    var form = document.querySelector("#remind-form");
    var form2 = document.querySelector("#login-form");
    form.classList.toggle('remind-form');
    form.classList.toggle('remind-form-visible');
    form2.classList.toggle('turn-of-form');

});