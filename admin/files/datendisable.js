
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


if (state == 1) { 
    document.getElementById('erfolg').style.display = "block";
}
else{
    document.getElementById('erfolg').style.display = "none";
}
