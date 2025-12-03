document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    navbar.classList.add("fade-in");
});

// Kleine hover geluidsfeedback (optioneel)
function playHoverSound() {
    const audio = new Audio("https://assets.mixkit.co/sfx/preview/mixkit-select-click-1109.mp3");
    audio.volume = 0.15;
    audio.play();
}

// Voeg hover sound toe aan nav-links
document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("mouseenter", playHoverSound);
});

// Voor register-pagina toggle
document.querySelectorAll(".register-toggle").forEach(toggle => {
    toggle.addEventListener("click", () => {
        const pwd = document.getElementById("password");
        const type = pwd.type === "password" ? "text" : "password";
        pwd.type = type;

        toggle.querySelector("i").classList.toggle("fa-eye");
        toggle.querySelector("i").classList.toggle("fa-eye-slash");
    });
});

function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}
// het wachtwoord onzichtbaar maken
function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;
//event listener hoe je bepaald of het wachtwoord zichtbaar is of niet. 
// als passwordShown/ pwShown 0 is dan word het zichtbaar gemaakt en als het 1 is dan word het onzichtbaar gemaakt
document.getElementById("eye").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);

