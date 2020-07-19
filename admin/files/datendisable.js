
if(urechte < 3){
    document.getElementById("anfang").disabled = true;
    document.getElementById("ende").disabled = true;
    document.getElementById("jahr").disabled = true;
    document.getElementById("preis").disabled = true;
    document.getElementById("shirtpreis").disabled = true;
    document.getElementById("kontaktmail").disabled = true;
    document.getElementById("anmeldungmail").disabled = true;
    document.getElementById("supportmail").disabled = true;
}

console.log(document.getElementById('erfolg'));

if (document.getElementById('erfolg').innerHTML.indexOf("word") != -1) { 
    console.log("Keinen Text erkannt!");
}
else{
    console.log("Text erkannt");
    document.getElementById('erfolg').style.display = "block";
}
