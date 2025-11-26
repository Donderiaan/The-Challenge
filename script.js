
// het wachtwoord zichtbaar maken
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

