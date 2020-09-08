//wird auf jeder Seite geladen
window.onload = function(){

    //liest den Momentanen Pfad aus
    const pfad = window.location.pathname;

    // je nachdem welcher Pfad wird das jeweilige Nav-Item eingefärbt
    switch(pfad){
        case "/":
            document.getElementById('index').element.classList.add("active");
            break;
        case "/index.php":
            document.getElementById('index').element.classList.add("active");
            break;
        case "/news.php":
            document.getElementById('news').element.classList.add("active");
            break;
        case "/team.php":
            document.getElementById('team').element.classList.add("active");
            break;
        case "/shop.php":
            document.getElementById('shop').element.classList.add("active");
            break;
        case "/download.php":
            document.getElementById('download').element.classList.add("active");
            break;
        case "/anmeldung/":
            document.getElementById('anmeldung').element.classList.add("active");
            break;
        case "/anmeldung/index.php":
            document.getElementById('anmeldung').element.classList.add("active");
            break;
        case "/anmeldung/online.php":
            document.getElementById('anmeldung').element.classList.add("active");
            break;
        case "/anmeldung/senden.php":
            document.getElementById('anmeldung').element.classList.add("active");
            break;
        case "/galerie/start.php":
            document.getElementById('galerie').element.classList.add("active");
            break;
        default:
            break;
    }
}