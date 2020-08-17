switch(message){
    case 1:
        document.getElementById("messagebox").innerHTML = "Der User wurde gelöscht.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#4CAF50";
        break;
    case 2:
        document.getElementById("messagebox").innerHTML = "Der User konnte leider nicht gelöscht werden.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#f44336";
        break;
    case 3:
        document.getElementById("messagebox").innerHTML = "Der User wurde angelegt und kann verwendet werden.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#4CAF50";
        break;
    case 4:
        document.getElementById("messagebox").innerHTML = "Der User konnte leider nicht angelegt werden.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#f44336";
        break;
    case 5:
        document.getElementById("messagebox").innerHTML = "Der User wurde bearbeitet.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#4CAF50";
        break;
    case 6:
        document.getElementById("messagebox").innerHTML = "Der User konnte leider nicht bearbeitet werden.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#f44336";
        break;
    case 7:
        document.getElementById("messagebox").innerHTML = "Bei der verarbeitung ist etwas schief gelaufen. </br> Bitte versuche es später erneut.";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#f44336";
        break;
    case 8:
        document.getElementById("messagebox").innerHTML = "Das Passwort hat nicht übereingestimmt, bitte versuch es nochmal!";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#f44336";
        break;
    case 9:
        document.getElementById("messagebox").innerHTML = "Du kannst deinen eigenen Benutzer nicht löschen!";
        document.getElementById("messagebox").style.display = "block";
        document.getElementById("messagebox").style.backgroundColor = "#f44336";
        break;
}