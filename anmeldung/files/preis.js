//die Felder aus dem Formular sind in check.js mit Konstanten Belegt
const preis = document.getElementById('preis');

//beim clicken auf die jeweiligen Felder die was mit dem preis zu tun haben
//neuen preis berechenn und ausgeben
shirt_nein.addEventListener("click", function(){
    console.log("click auf nein erkannt");
    preis.innerHTML = basis;
});

shirt_ja.addEventListener("click", function(){
    console.log("click auf ja erkannt");
    preis.innerHTML = basis + 1 * shirt;
});

shirtanzahl.addEventListener("change", function(){
    console.log("click auf anzahl erkannt");
    preis.innerHTML = basis + shirtanzahl.value * shirt;
    shirtgroesse.focus();
})