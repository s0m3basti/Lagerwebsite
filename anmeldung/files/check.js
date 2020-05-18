    const form = document.getElementById('anmeldung');
    const kind_name = document.getElementById('kind_name');
    const kind_nachname = document.getElementById('kind_nachname');
    const kind_geschlecht_female = document.getElementById('kind_geschlecht_female');
    const kind_geschlecht_male = document.getElementById('kind_geschlecht_male');
    const kind_geb = document.getElementById('kind_geb');
    const eltern_name = document.getElementById('eltern_name');
    const eltern_vorname = document.getElementById('eltern_vorname');
    const strasse = document.getElementById('strasse');
    const plz = document.getElementById('plz');
    const ort = document.getElementById('ort');
    const tel_priv = document.getElementById('tel_priv');
    const tel_handy = document.getElementById('tel_handy');
    const tel_dienst = document.getElementById('tel_dienst');
    const email = document.getElementById('email');
    const mitglied = document.getElementById('mitglied');
    const mitarbeiter = document.getElementById('mitarbeiter');
    const schwimmer_ja = document.getElementById('schwimmer_ja');
    const schwimmer_nein = document.getElementById('schwimmer_nein');
    const schwimmstufe = document.getElementById('schwimmstufe');
    const baden_ja = document.getElementById('baden_ja');
    const baden_nein = document.getElementById('baden_nein');
    const springen_ja = document.getElementById('springen_ja');
    const springen_nein = document.getElementById('springen_nein');
    const ernaehrung = document.getElementById('ernaehrung');
    const krankheit = document.getElementById('krankheit');
    const medizin = document.getElementById('medizin');
    const geld_ja = document.getElementById('geld_ja');
    const geld_nein = document.getElementById('geld_nein');
    const kv_art_prv = document.getElementById('kv_art_prv');
    const kv_art_ges = document.getElementById('kv_art_ges');
    const versicherung = document.getElementById('versicherung');
    const kfz_ja = document.getElementById('kfz_ja');
    const kfz_nein = document.getElementById('kfz_nein');
    const raten_ja = document.getElementById('raten_ja');
    const raten_nein = document.getElementById('raten_nein');
    const anzahl = document.getElementById('anzahl');
    const shirt_ja = document.getElementById('shirt_ja');
    const shirt_nein = document.getElementById('shirt_nein');
    const shirtgroesse = document.getElementById('shirtgroesse');
    const shirtanzahl = document.getElementById('shirtanzahl');

    const regExBuchst = new RegExp("[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð\\-\\ ]*$");
    const regExStr = new RegExp("[a-zA-ZäöüÄÖÜ0-9ß\\-\\.\\,\\  ]*$");
    const regExplz = new RegExp("[0-9]*$");
    const regExort = new RegExp("[a-zA-ZäöüÄÖÜ\\- ]*$");
    const regExtel = new RegExp("[0-9\\/\\+\\- ]*$");
    const regExemail = new RegExp ("^[a-zA-Z0-9.\\-]{1,64}@[a-zA-Z0-9.\\-]{1,255}.[a-zA-Z]{2,}$");
    const regExtext = new RegExp("[a-zA-Z0-9äöüÄÖÜ.,!?:\\/\\(\\)\\- ]*$");
    

    kind_name.onblur = function(){
        let nachricht = document.getElementById('er_kind_name');
        if(kind_name.value.length > 50){
            nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
            kind_name.style.border = '2px solid red';
        }
        else{
            if(kind_name.value.length < 2){
                nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
                kind_name.style.border = '2px solid red';
            }
            else{
                if(kind_name.value.match(regExBuchst).index != 0){
                    nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
                    kind_name.style.border = '2px solid red';
                }
                else{
                    kind_name.style.border = '1px solid black';
                    nachricht.innerHTML = '';
                }
            }
        }  
    }
    kind_nachname.onblur = function(){
        let nachricht = document.getElementById('er_kind_nachname');
        if(kind_nachname.value.length > 50){
            nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
            kind_nachname.style.border = '2px solid red';
        }
            else{
                if(kind_nachname.value.length < 2){
                    nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
                    kind_nachname.style.border = '2px solid red';
                }
                else{
                    if(kind_nachname.value.match(regExBuchst).index != 0){
                        nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
                        kind_nachname.style.border = '2px solid red';
                    }
                    else{
                        kind_nachname.style.border = '1px solid black';
                        nachricht.innerHTML = '';
                    }
                }
            }  
        }
    kind_geschlecht_male.onblur = function(){
        let nachricht = document.getElementById('er_kind_geschlecht')
        if(kind_geschlecht_male.checked == true || kind_geschlecht_female.checked == true){
            nachricht.innerHTML = '';
        }
        else{
            nachricht.innerHTML = 'Bitte geben sie ein Geschlecht an!';
        }
    }
    kind_geschlecht_female.onblur = function(){
        let nachricht = document.getElementById('er_kind_geschlecht')
        if(kind_geschlecht_male.checked == true || kind_geschlecht_female.checked == true){
            nachricht.innerHTML = '';
        }
        else{
            nachricht.innerHTML = 'Bitte geben sie ein Geschlecht an!';
        }
    }
    kind_geb.onblur = function(){
        let nachricht = document.getElementById('er_kind_geb');
        if(kind_geb.value.length == 0){
            nachricht.innerHTML = 'Bitte geben sie ein vollständiges Geburtsdatum ein!';
            kind_geb.style.border = '2px solid red';
        }
        else{
            nachricht.innerHTML = '';
            kind_geb.style.border = '1px solid black';
        }
    }
    eltern_name.onblur = function(){
        let nachricht = document.getElementById('er_eltern_name');
        if(eltern_name.value.length > 50){
            nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
            eltern_name.style.border = '2px solid red';
        }
        else{
            if(eltern_name.value.length < 0){
                nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
                eltern_name.style.border = '2px solid red';
            }
            else{
                if(eltern_name.value.length < 2){
                    nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
                    eltern_name.style.border = '2px solid red';
                }
                else{
                    if(eltern_name.value.match(regExBuchst).index != 0){
                        nachricht.innerHTML = 'Bitte geben sie einen richtigen Nachnamen ein!';
                        eltern_name.style.border = '2px solid red';
                    }
                    else{
                        eltern_name.style.border = '1px solid black';
                        nachricht.innerHTML = '';
                    }
                }
            }  
        }
    }
    eltern_vorname.onblur = function(){
        let nachricht = document.getElementById('er_eltern_vorname');
        if(eltern_vorname.value.length > 50){
            nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
            eltern_vorname.style.border = '2px solid red';
        }
        else{
            if(eltern_vorname.value.length < 0){
                nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
                eltern_vorname.style.border = '2px solid red';
            }
            else{
                if(eltern_vorname.value.length < 2){
                    nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
                    eltern_vorname.style.border = '2px solid red';
                }
                else{
                    if(eltern_vorname.value.match(regExBuchst).index != 0){
                        nachricht.innerHTML = 'Bitte geben sie einen richtigen Vornamen ein!';
                        eltern_vorname.style.border = '2px solid red';
                    }
                    else{
                        eltern_vorname.style.border = '1px solid black';
                        nachricht.innerHTML = '';
                    }
                }
            }  
        }
    }
    strasse.onblur = function(){
        let nachricht = document.getElementById('er_strasse');
        if(strasse.value.length > 100){
            nachricht.innerHTML = 'Bitte geben sie einen gültigen Straßennamen ein!';
            strasse.style.border = '2px solid red';
        }
        else{
            if(strasse.value.length < 2){
                nachricht.innerHTML = 'Bitte geben sie einen gültigen Straßennamen ein!';
                strasse.style.border = '2px solid red';
            }
            else{
                if(strasse.value.match(regExStr).index != 0){
                    nachricht.innerHTML = 'Bitte geben sie einen gültigen Straßennamen ein!'
                    strasse.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    strasse.style.border = '1px solid black';
                }
            }
        }
    }
    plz.onblur = function(){
        let nachricht = document.getElementById('er_plz');
        if(plz.value.length > 5){
            nachricht.innerHTML = 'Bitte geben sie eine gültige Postleitzahl ein!';
            plz.style.border = '2px solid red';
        }
        else{
            if(plz.value.length < 5){
                nachricht.innerHTML = 'Bitte geben sie eine gültige Postleitzahl ein!';
                plz.style.border = '2px solid red';
            }
            else{
                if(plz.value.match(regExplz).index != 0){
                    nachricht.innerHTML = 'Bitte verwenden sie nur Zahlen!'
                    plz.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    plz.style.border = '1px solid black';
                }
            }
        }
    }
    ort.onblur = function(){
        let nachricht = document.getElementById('er_ort');
        if(ort.value.length > 50){
            nachricht.innerHTML = 'Bitte geben sie einen gültigen Ortsnamen ein!';
            ort.style.border = '2px solid red';
        }
        else{
            if(ort.value.length < 2){
                nachricht.innerHTML = 'Bitte geben sie einen gültigen Ortsnamen ein!';
                ort.style.border = '2px solid red';
            }
            else{
                if(ort.value.match(regExort).index != 0){
                    nachricht.innerHTML = 'Bitte verwenden sie nur Buchstaben!'
                    ort.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    ort.style.border = '1px solid black';
                }
            }
        }
    }
    tel_priv.onblur = function(){
        let nachricht = document.getElementById('er_tel_priv');
        if(tel_priv.value.length > 0){
            if(tel_priv.value.length > 20){
                nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer ein!';
                tel_priv.style.border = '2px solid red';
            }
            else{
                if(tel_priv.value.length < 6){
                    nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer ein!';
                    tel_priv.style.border = '2px solid red';
                }
                else{
                    if(tel_priv.value.match(regExtel).index != 0){
                        nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!'
                        tel_priv.style.border = '2px solid red';
                    }
                    else{
                        nachricht.innerHTML = '';
                        tel_priv.style.border = '1px solid black';
                    }
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            tel_priv.style.border = '1px solid black';
        }
    }
    tel_handy.onblur = function(){
        let nachricht = document.getElementById('er_tel_handy');
        if(tel_handy.value.length > 0){
            if(tel_handy.value.length > 20){
                nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!';
                tel_handy.style.border = '2px solid red';
            }
            else{
                if(tel_handy.value.length < 6){
                    nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!';
                    tel_handy.style.border = '2px solid red';
                }
                else{
                    if(tel_handy.value.match(regExtel).index != 0){
                        nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!'
                        tel_handy.style.border = '2px solid red';
                    }
                    else{
                        nachricht.innerHTML = '';
                        tel_handy.style.border = '1px solid black';
                    }
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            tel_handy.style.border = '1px solid black';
        }
    }
    tel_dienst.onblur = function(){
        let nachricht = document.getElementById('er_tel_dienst');
        if(tel_dienst.value.length > 0){
            if(tel_dienst.value.length > 20){
                nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!';
                tel_dienst.style.border = '2px solid red';
            }
            else{
                if(tel_dienst.value.length < 6){
                    nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!';
                    tel_dienst.style.border = '2px solid red';
                }
                else{
                    if(tel_dienst.value.match(regExtel).index != 0){
                        nachricht.innerHTML = 'Bitte geben sie eine gültige Telefonnummer an!'
                        tel_dienst.style.border = '2px solid red';
                    }
                    else{
                        nachricht.innerHTML = '';
                        tel_dienst.style.border = '1px solid black';
                    }
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            tel_dienst.style.border = '1px solid black';
        }
    }
    email.onblur = function(){
        let nachricht = document.getElementById('er_email');
        if(email.value.length > 320){
            nachricht.innerHTML = 'Bitte geben sie eine gültige E-Mail-Adresse ein!';
            email.style.border = '2px solid red';
        }
        else{
            if(email.value.length < 3){
                nachricht.innerHTML = 'Bitte geben sie eine gültige E-Mail-Adresse ein!';
                email.style.border = '2px solid red';
            }
            else{
                if(email.value.match(regExemail)){
                    nachricht.innerHTML = '';
                    email.style.border = '1px solid black';
                }
                else{
                    nachricht.innerHTML = 'Bitte geben sie eine gültige E-Mail-Adresse ein!'
                    email.style.border = '2px solid red';
                }
            }
        }
    }
    //mitglied
    //mitarbeiter 
    schwimmer_ja.onclick = function(){
        schwimmstufe.disabled = false;
    }
    schwimmer_nein.onclick = function(){
        schwimmstufe.disabled = true;
        schwimmstufe.value = '';
    }
    schwimmstufe.onblur = function(){
        let nachricht = document.getElementById('er_schwimmstufe');
        if(schwimmstufe.value.length > 0){
            if(schwimmstufe.value.length > 20){
                nachricht.innerHTML = 'Bitte maximal 20 Zeichen!';
                schwimmstufe.style.border = '2px solid red';
            }
            else{
                if(schwimmstufe.value.match(regExBuchst).index != 0){
                    nachricht.innerHTML = 'Bitte nur Buchstaben!';
                    schwimmstufe.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    schwimmstufe.style.border = '1px solid black';
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            schwimmstufe.style.border = '1px solid black';
        }
    }
    //baden
    //springen
    ernaehrung.onblur = function(){
        let nachricht = document.getElementById('er_ernaehrung');
        if(ernaehrung.value.length > 0){
            if(ernaehrung.value.length > 1000){
                nachricht.innerHTML = 'Bitte nur 1000 Zeichen!';
                ernaehrung.style.border = '2px solid red';
            }
            else{
                if(ernaehrung.value.match(regExtext).index != 0){
                    nachricht.innerHTML = 'Nur Text und folgende Sonderzeichen (. , / ( ) -)!';
                    ernaehrung.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    ernaehrung.style.border = '1px solid black';
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            ernaehrung.style.border = '1px solid black';
        }
    }
    krankheit.onblur = function(){
        let nachricht = document.getElementById('er_krankheit');
        if(krankheit.value.length > 0){
            if(krankheit.value.length > 1000){
                nachricht.innerHTML = 'Bitte nur 1000 Zeichen!';
                krankheit.style.border = '2px solid red';
            }
            else{
                if(krankheit.value.match(regExtext).index != 0){
                    nachricht.innerHTML = 'Nur Text und folgende Sonderzeichen (. , / ( ) -)!';
                    krankheit.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    krankheit.style.border = '1px solid black';
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            krankheit.style.border = '1px solid black';
        }
    }
    medizin.onblur = function(){
        let nachricht = document.getElementById('er_medizin');
        if(medizin.value.length > 0){
            if(medizin.value.length > 1000){
                nachricht.innerHTML = 'Bitte nur 1000 Zeichen!';
                medizin.style.border = '2px solid red';
            }
            else{
                if(medizin.value.match(regExtext).index != 0){
                    nachricht.innerHTML = 'Nur Text und folgende Sonderzeichen (. , / ( ) -)!';
                    medizin.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    medizin.style.border = '1px solid black';
                }
            }
        }
        else{
            nachricht.innerHTML = '';
            medizin.style.border = '1px solid black';
        }
    }
    //geld 22
    kv_art_prv.onclick = function(){
        versicherung.disabled = false;
    }
    kv_art_ges.onclick = function(){
        versicherung.disabled = false;
    }
    kv_art_prv.onblur = function(){
        let nachricht = document.getElementById('er_kvart');
        if(kv_art_ges.checked == true || kv_art_prv.checked == true){
            nachricht.innerHTML = '';
        }
        else{
            nachricht.innerHTML = 'Bitte geben sie die Art und den Namen der Krankenversicherung ein!'
        }
    }
    kv_art_ges.onblur = function(){
        let nachricht = document.getElementById('er_kvart');
        if(kv_art_ges.checked == true || kv_art_prv.checked == true){
            nachricht.innerHTML = '';
        }
        else{
            nachricht.innerHTML = 'Bitte geben sie die Art und den Namen der Krankenversicherung ein!'
        }
    }

    versicherung.onblur = function(){
        let nachricht = document.getElementById('er_versicherung');
        if(versicherung.value.length > 100){
            nachricht.innerHTML = 'Bitte geben sie eine gültige Versicherung ein!';
            versicherung.style.border = '2px solid red';
        }
        else{
            if(versicherung.value.length < 2){
                nachricht.innerHTML = 'Bitte geben sie eine gültige Versicherung ein!';
                versicherung.style.border = '2px solid red';
            }
            else{
                if(versicherung.value.match(regExtext).index != 0){
                    nachricht.innerHTML = 'Bitte geben sie eine gültige Versicherung ein!';
                    versicherung.style.border = '2px solid red';
                }
                else{
                    nachricht.innerHTML = '';
                    versicherung.style.border = '1px solid black';
                }
            }
        }
    }
    //kfz 25
    raten_ja.onclick = function(){
        anzahl.disabled = false;
        anzahl.value = 3;
    }
    raten_nein.onclick = function(){
        let nachricht = document.getElementById('er_anzahl');
        anzahl.disabled = true;
        anzahl.value =  '';
        nachricht.innerHTML = '';
        anzahl.style.border = '1px solid black';
    }
    anzahl.onblur = function(){
        let nachricht = document.getElementById('er_anzahl');
        if(raten_ja.checked == true){
            if(anzahl.value.length > 0){
                nachricht.innerHTML = '';
                anzahl.style.border = '1px solid black';
            }
            else{
                nachricht.innerHTML = 'Geben sie eine Ratenanzahl an!';
                anzahl.style.border = '2px solid red';
            }
        }
    }
    shirt_ja.onclick = function(){
        shirtanzahl.disabled = false;
        shirtanzahl.value = 1;
        shirtgroesse.disabled = false;
        shirtgroesse.value = "default";
    }
    shirt_nein.onclick = function(){
        let nachricht = document.getElementById('er_shirtgroesse');
        shirtanzahl.disabled = true;
        shirtgroesse.disabled = true;
        shirtanzahl.value = '';
        shirtgroesse.value = '';
        shirtgroesse.style.border = '1px solid black';
        shirtanzahl.style.border = '1px solid black';
        nachricht.innerHTML = '';
    }
    shirtanzahl.onblur = function(){
        if(shirt_ja.checked == true){
            if(shirtanzahl.value > 5){
                shirtanzahl.style.border = '2px solid red';
            }
            else{
                if(shirtanzahl.value < 1){
                    shirtanzahl.style.border = '2px solid red';
                }
                else{
                    shirtanzahl.style.border = '1px solid black';
                }
            }
        }
    }
    shirtgroesse.onblur = function(){
        let nachricht = document.getElementById('er_shirtgroesse');
        if(shirt_ja.checked == true){
            if(shirtgroesse.value === "default" || shirtgroesse.value === "cool"){
                nachricht.innerHTML = 'Bitte wählen sie eine Größe aus!';
                shirtgroesse.style.border = '2px solid red';
            }
            else{
                nachricht.innerHTML = '';
                shirtgroesse.style.border = '1px solid black';
            }
        }
    }


    document.getElementById('submit').addEventListener("click", function(e){
        let messages = []

                if(kind_name.value.length > 50 || kind_name.value.length < 2 || kind_name.value.match(regExBuchst).index != 0){
                    console.log("ich war hier");
                    kind_name.focus();
                    messages.push("Geben sie einen gültigen Vornamen ein!");
                }

                if(kind_nachname.value.length > 50 || kind_nachname.value.length < 2 || kind_nachname.value.match(regExBuchst).index != 0){
                    console.log("ich war hier");
                    kind_nachname.focus();
                    messages.push("Geben sie einen gültigen Nachnamen ein!");
                }

                if(kind_geschlecht_male.checked == false && kind_geschlecht_female.checked == false){
                    console.log("ich war hier");
                    kind_geschlecht_female.focus();
                    messages.push("Geben sie ein Geschlecht an!");
                }

                if(kind_geb.value.length == 0){
                    console.log("ich war hier");
                    kind_geb.focus();
                    messages.push("Geben sie ein gültiges Geburtsdatum ein!");
                }

                if(eltern_name.value.length > 50 || eltern_name.value.length < 2 || eltern_name.value.match(regExBuchst).index != 0){
                    console.log("ich war hier");
                    eltern_name.focus();
                    messages.push("Geben sie einen gültigen Nachnamen an!");
                }

                if(eltern_vorname.value.length > 50 ||eltern_vorname.value.length < 2 || eltern_vorname.value.match(regExBuchst).index != 0){
                    console.log("ich war hier");
                    eltern_vorname.focus();
                    messages.push("Geben sie einen gültigen Vornamen ein!");
                }

                if(strasse.value.length > 100 || strasse.value.length < 2 || strasse.value.match(regExStr).index != 0){
                    console.log("ich war hier");
                    strasse.focus();
                    messages.push("Geben sie einen gültigen Straßennamen ein!");
                }

                if(plz.value.length > 5 || plz.value.length < 5 || plz.value.match(regExplz).index != 0){
                    console.log("ich war hier");
                    plz.focus();
                    messages.push("Geben sie eine gültige Postleitzahl ein!");
                }

                if(ort.value.length < 2 || ort.value.length > 50 || ort.value.match(regExort).index != 0){
                    console.log("ich war hier");
                    ort.focus();
                    messages.push("Geben sie eine gültigen Ortsnamen ein!");
                }

                if(tel_priv.value.length > 0){
                    if(tel_priv.value.length > 20 || tel_priv.value.length < 6 || tel_priv.value.match(regExtel).index != 0){
                        console.log("ich war hier");
                        tel_priv.focus();
                        messages.push("Geben sie eine gülitge (oder keine) private Telefonnummer ein!");
                    }
                }
                if(tel_handy.value.length > 0){
                    if(tel_handy.value.length > 20 || tel_handy.value.length < 6 || tel_handy.value.match(regExtel).index != 0){
                        console.log("ich war hier");
                        tel_handy.focus();
                        messages.push("Geben sie eine gülitge (oder keine) Handynummer ein!");
                    }
                }

                if(tel_dienst.value.length > 0){
                    if(tel_dienst.value.length > 20 || tel_dienst.value.length < 6 || tel_dienst.value.match(regExtel).index != 0){
                        console.log("ich war hier");
                        tel_dienst.focus();
                        messages.push("Geben sie eine gülitge (oder keine) dienst Telefonnummer ein!");
                    }
                }

                if(email.value.length > 320 || email.value.length < 3){
                    console.log("ich war hier");
                    email.focus();
                    messages.push("Geben sie eine gültige E-Mail-Adresse ein!");
                }

                if(schwimmstufe.value.length > 0){
                    if(schwimmstufe.value.length > 20 || schwimmstufe.value.match(regExBuchst).index != 0){
                        schwimmstufe.focus();
                        messages.push("Geben sie eine gültige oder keine Schwimmstufe ein!")
                    }
                }

                if(ernaehrung.value.length > 0){
                    if(ernaehrung.value.length > 1000 || ernaehrung.value.match(regExtext).index != 0){
                        console.log("Ich war bei ernaehrung");
                        ernaehrung.focus();
                        messages.push("Geben sie eine gülige beschreibung der Ernährung ein!");
                    }
                }

                if(krankheit.value.length > 0){
                    if(krankheit.value.length > 1000 || krankheit.value.match(regExtext).index != 0){
                        console.log("Ich war bei krankheit");
                        krankheit.focus();
                        messages.push("Geben sie eine gülige beschreibung der Erkrankung ein!");
                    }
                }

                if(medizin.value.length > 0){
                    if(medizin.value.length > 1000 || medizin.value.match(regExtext).index != 0){
                        console.log("Ich war bei medizin");
                        medizin.focus();
                        messages.push("Geben sie eine gülige beschreibung der Medikamente ein!");
                    }
                }

                if(kv_art_ges.checked == false && kv_art_prv.checked == false){
                    console.log("ich war hier");
                    kv_art_ges.focus();
                    messages.push("Geben sie die Art und Namen ihrer Krankenkasse ein");
                }
                
                if(versicherung.value.length > 100 || versicherung.value.length < 2 || versicherung.value.match(regExtext).index != 0){
                    console.log("ich war hier");
                    versicherung.focus();
                    messages.push("Geben sie den Namen ihrer Krankenkasse ein!");
                }

                if(raten_ja.checked == true){
                    if(anzahl.value.length > 0){
                    }
                    else{
                        anzahl.focus();
                        messages.push("Geben sie eine Ratenanzahl ein oder geben sie Nein an!")
                    }
                }

                if(shirt_ja.checked == false && shirt_nein.checke == false){
                    console.log("ich war hier");
                    shirt_nein.focus();
                    messages.push("Geben sie an ob sie Lagershirts mitbestellen wollen");
                }

                if(shirt_ja.checked == true){
                    if(shirtanzahl.value > 5 || shirtanzahl.value < 1 || shirtgroesse.value === "default" || shirtgroesse.value === "cool"){
                        shirtanzahl.focus();
                        shirtgroesse.focus();
                        messages.push("Geben sie eine Anzahl und eine Größe der Shirts ein oder wählen sie nein aus!")
                    }
                }


                if (messages.length > 0){
                    e.preventDefault();
                    document.getElementById('er_submit').innerHTML = messages.join("<br/>");
                    document.getElementById('submit').focus();
                }
        
    });
