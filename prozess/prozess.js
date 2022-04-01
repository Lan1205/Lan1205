
//Bestellte und bearbeitete Reifensets auf Bildschirm bestätigen und zeigen
var reifen = "";
var zahl = 1;
var span0Index = 0;
var span1Index = 1;
var span2Index = 2;
var bestellungIndex = 0;
var druckIndex = 1;
var tdFlIndex = -4;
var tdFrIndex = -3;
var tdBlIndex = -2;
var tdBrIndex = -1;

/* Unbenutzt
function addReifenSet() {
    let zeit = document.getElementById("zeit").value;
    let regex = /[a-z]/;
    if (regex.test(zeit)) {
        alert("Eingabe der Zeit ungültig");
        return;
    }  

    let vorder = document.getElementById("vorder").value;
    let hinter = document.getElementById("hinter").value;

    let numerierung = "";
    let zeichnung = "";

    if (vorder=="eg" && hinter == "eg") {zeichnung = "-/-";}   
    else if (vorder=="eg" && hinter == "si") { zeichnung= "-/|";}
    else if (vorder=="eg" && hinter == "egsi") {zeichnung = "-/+";}
    else if (vorder=="si" && hinter == "eg") {zeichnung ="|/-";}
    else if (vorder=="si" && hinter == "si") {zeichnung="|/|";}
    else if (vorder=="si" && hinter == "egsi") {zeichnung="|/+";}
    else if (vorder=="egsi" && hinter == "eg") {zeichnung="+/-";}
    else if (vorder=="egsi" && hinter == "si") {zeichnung="+/|";}
    else if (vorder=="egsi" && hinter == "egsi") {zeichnung= "+/+";}
    
    switch (document.getElementById("bestellung").value) {
        case "1": numerierung = "1"+zahl;
                break;
        case "2": numerierung = "2" + zahl;
                break;
        case "3": numerierung = "3" + zahl;
                break;
        case "4": numerierung= "4" + zahl;
                break;
        case "5": numerierung = "5" + zahl;
                break;
        case "7": numerierung = "7" + zahl;
                break;
        default: numerierung="";
        break;
    }

    if (zahl < 10) {
        numerierung = [numerierung.slice(0,1),"0",numerierung.slice(1)].join("");
    }
    reifen = numerierung + zeichnung;
    addTabelle(reifen);
    zahl = zahl+1;

}

//Tabelle auf Bildschirm zeigen
function addTabelle(reifenName) { 
    let template = `
    <section id="">
    <p style="margin:5px;font-weight:bold">Reifenset: ${reifenName}</p>
    <section id="smallSection">
        <nav class="item">
            <div style="padding:3px">
            <p>Bestellung</p><br>
            <p>Time left: <span></span></p>
            
            </div>
        </nav>
        <nav class="item">
            <div style="padding: 3px">
            <p>Reifendruck</p>
            <table>
                <tr>
                    <td>(fl)</td>
                    <td>(fr)</td>   
                </tr>
                <tr>
                    <td>(bl)</td>
                    <td>(br)</td>
                </tr>
            </table>
            </div>
        </nav>
        <nav class="item">
            <div style="padding:3px">
                <p>In Heizdecke <span></span></p>
                <p>Time left: </p>
                <span></span>
            </div>
        </nav>
        <nav class="item">
            <div style="padding:3px">
                <p>Montieren</p>
            </div>
        </nav>
        <nav class="item">
            <div style="padding:3px">
                <p>Fertig</p>
            </div>
        </nav>
    </section>
</section>
    `;
    
    document.getElementById("progress").innerHTML += template;
    document.getElementsByClassName("item")[bestellungIndex].id=reifenName;
    
    tdFlIndex += 4;
    tdFrIndex += 4;
    tdBlIndex += 4;
    tdBrIndex += 4;
}*/


//zählt für jede Bestellung das Kontingent runter
function kontingentMindern(){
    var zahl = document.getElementById("kont").value
    zahl = zahl- 1;
    document.getElementById("kont").value = zahl;
    sessionStorage.setItem("a", zahl);
}

//Timer für Bestellung fangt an, zu zählen
function timerBestellung() {
    let time = document.getElementById("zeit").value;
    let seconds = time*60;
    let regex = /[a-z]/;
    if (regex.test(seconds)) {
        return null;
    }  
    //Der Button als "disabled" setzen
    document.getElementById("bestellen").setAttribute("disabled","disabled");

    displayTime(seconds);

    const count = setInterval (() => {
        seconds--;
        displayTime(seconds);
        if(seconds <= 0 || seconds < 1) {
            clearInterval(count);
            endTime();
            
        }
    },1000);
    
}

function displayTime(second) {
    let timeOutput = document.getElementsByTagName("span")[span0Index];
    let min=Math.floor(second/60);
    let sec=Math.floor(second%60);

    timeOutput.innerHTML=`${min<10 ? "0" : ""}${min}:${sec<10 ? "0" : ""}${sec}`;
}

function endTime() {
    let bestelltId = document.getElementsByClassName("item")[bestellungIndex].id;
    let timeOutput = document.getElementsByTagName("span")[span0Index];
    timeOutput.innerHTML="00:00";
    document.getElementById(bestelltId).style.backgroundColor = "rgb(111, 189, 111)";
    //document.getElementById("bestellen").removeAttribute("disabled");
    document.getElementById("bestellen").disabled=false;
    span0Index+=3;
    bestellungIndex+=5;
}

//Reifendruck angepasst ausdrucken
function druckOutput() {
    let fertig = document.getElementById("druckMessungFertig");
    let formel = document.getElementById("formel").value;
    let tdFl = document.getElementsByTagName("td")[tdFlIndex];
    let tdFr = document.getElementsByTagName("td")[tdFrIndex];
    let tdBl = document.getElementsByTagName("td")[tdBlIndex];
    let tdBr = document.getElementsByTagName("td")[tdBrIndex];

    let select = document.getElementById("position");

    let result = math.round(math.evaluate(formel),2);

    switch(select.value) {
        case "frontLeft":
            tdFl.innerHTML = result; 
            break;
        case "frontRight":
            tdFr.innerHTML = result;
            break;
        case "backLeft":
            tdBl.innerHTML = result;
            break;
        case "backRight":
            tdBr.innerHTML = result; 
            break;
    }
    
}
// Farbe der Teil "Reifendruck" nach grün wechseln
function druckFertig() {
    let fertig = document.getElementsByClassName("item")[druckIndex];
    fertig.style.backgroundColor = "rgb(111, 189, 111)";
    druckIndex +=5;
}

// Temperatur Grad zeigen (40 oder 90)
function gradZeigen(){
    let grad = document.getElementById("grad").value;
    let out = document.getElementsByTagName("span")[span1Index];
    if (grad == "40") {
        out.innerHTML = "(40°)";
    } else if (grad == "90") {
        out.innerHTML = "(90°)";
    }
    span1Index+=3;
}
//Timer in Heizdecke fangt an, zu zählen
function timerHeizdecke() {
    document.getElementById("inHeizdecke").setAttribute("disabled","disabled");
    let minutes = 1;
    let seconds = minutes*60;
    display90(seconds);


    const a = setInterval (() => {
        seconds--;
        display90(seconds);
        if(seconds <= 0 || seconds < 1) {
            clearInterval(a);
            end90();
            
        }
    },1000);
}

function display90(second) {
    let output = document.getElementsByTagName("span")[span2Index];
    let hour = Math.floor(second/3600);
    let min = Math.floor(second/60%60);
    let sec = Math.floor(second%60);

    output.innerHTML = `0${hour}:${min<10 ? "0" : ""}${min}:${sec<10 ? "0" : ""}${sec}`;
}



function end90() {
    let output = document.getElementsByTagName("span")[span2Index];
    output.innerHTML = "Done";
    document.getElementById("inHeizdecke").removeAttribute("disabled");
    span2Index+=3;
}

//Reifenset bearbeiten können
function editReifenset(setID, reifBez)
{
    // document.getElementById('div_bearbeiten').style.display = 'inline';
    document.getElementById('showReifBez').innerHTML = reifBez;
    document.getElementById('ReifenID').value = setID;
    document.getElementById('ReifenID_2').value = setID;
    window.scroll({top: 0, left: 0});

}

// //Bearbeiten Optionen verstecken
// function hideEdit()
// {
//     document.getElementById('div_bearbeiten').style.display = 'none';
// }

// //Laden der Seite
// window.onload = function()
// {
//     //Verstecken der Bearbeiten Optionen
//     hideEdit();
// }

var form = document.getElementById("formAwesome");
// form.addEventListener("submit", onSubmitForm);

function onSubmitForm(e) {
    e.preventDefault();
    $('#formModal').modal('hide');
    $('#btnStart').hide();
    $('#message').show();
}