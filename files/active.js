//wird auf jeder Seite geladen
window.onload = function(){

    //liest den Momentanen Pfad aus
    const pfad = window.location.pathname;

    // je nachdem welcher Pfad wird das jeweilige Nav-Item eingefärbt
    switch(pfad){
        case "/":
            document.getElementById('index').style.backgroundColor = '#E60005';
            break;
        case "/index.php":
            document.getElementById('index').style.backgroundColor = '#E60005';
            break;
        case "/news.php":
            document.getElementById('news').style.backgroundColor = '#E60005';
            break;
        case "/team.php":
            document.getElementById('team').style.backgroundColor = '#E60005';
            break;
        case "/shop.php":
            document.getElementById('shop').style.backgroundColor = '#E60005';
            break;
        case "/download.php":
            document.getElementById('download').style.backgroundColor = '#E60005';
            break;
        case "/anmeldung/":
            document.getElementById('anmeldung').style.backgroundColor = '#E60005';
            break;
        case "/anmeldung/index.php":
            document.getElementById('anmeldung').style.backgroundColor = '#E60005';
            break;
        case "/anmeldung/online.php":
            document.getElementById('anmeldung').style.backgroundColor = '#E60005';
            break;
        case "/anmeldung/senden.php":
            document.getElementById('anmeldung').style.backgroundColor = '#E60005';
            break;
        case "/galerie/start.php":
            document.getElementById('galerie').style.backgroundColor = '#E60005';
            break;
        default:
            break;
    }
}