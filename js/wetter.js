//diagramm zeichnen
var xValues = [];
var tooltips = [];
let numberOfValues;
if(localStorage.getItem("number")!=null) {
  numberOfValues = localStorage.getItem("number");
} else {
  numberOfValues = 0;
}


var chart = new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    zustand: tooltips,
    datasets: [{ 
      label: "Luft",
      data: [],
      borderColor: "blue",
      fill: false
    }, { 
      label: "Strecke",
      data: [],
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: true},
    maintainAspectRatio: false,
    scales: {
      y: {
        suggestedMin: 0,
        suggestedMax: 40,
      }
     },
     plugins: {
      tooltip: {
          callbacks: {
            afterLabel: function(tooltipItem, data) {
              var text = chart.data.zustand[tooltipItem.dataIndex];
              return text;
            } 
          }
      }
  }
  }
  
});



//Wetterdaten hinzugefügen
function addWetter() {
  let time = new Date().toLocaleString();//document.getElementById("zeit").value;
  let luft = document.getElementById("luft").value;
  let strecke = document.getElementById("strecke").value;
  let verhaeltnis = document.getElementById("verhaeltnis").value;
  xValues.push(time);
  
  tooltips.push(verhaeltnis);

  if (time == "" || luft == /^$/ || strecke == /^$/ || verhaeltnis ===/^$/) {
    alert("Eingabe ungültig");
    return null;
  }
  chart.data.datasets[0].data.push(luft);
  chart.update();
  chart.data.datasets[1].data.push(strecke);
  chart.update();

  ++numberOfValues;
  localStorage.setItem("number",numberOfValues);
}

// Eingetragene Wetterdaten werden an die Datenbank geschickt
function submitWetterForm()
{
  var http = new XMLHttpRequest();
  var data = new FormData();
  var time = new Date().toLocaleString(); 
  var Mount_Date= time.substring(0,4);
  var Hours_Minute= time.substring(10,15);
  console.log(time); 
  data.append("messZeit", Mount_Date + ", " +Hours_Minute);
  data.append("luftTmp", document.getElementById("luft").value);
  data.append("streckeTmp", document.getElementById("strecke").value);
  data.append("verhaeltnis", document.getElementById("verhaeltnis").value);
  
  http.open("POST", "./php/saveWetter.php", true);
  http.send(data);

  return false;
}

// Wenn die Wetterseite geladen wird, werden die Daten aus der Datenbank eingefügt
window.onload = function()
{
  var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == XMLHttpRequest.DONE) 
        {
          var dsgetrennt = this.responseText.split("?");
          var allgetrennt;
          for (i = 0; i < dsgetrennt.length - 1; i++)
          {
            allgetrennt = dsgetrennt[i].split("!");
            addWeather(JSON.parse(allgetrennt[0]), JSON.parse(allgetrennt[1]), JSON.parse(allgetrennt[2]), JSON.parse(allgetrennt[3]));
          }
        }
    };

    
    request.open('GET', './php/loadWetter.php', true);
    request.send(); 
}

// Wetterdaten der Datenbank hinzufügen
function addWeather(xZeit, xLuft, xStrecke, xVerhaeltnis)
{
  xValues.push(xZeit);
  tooltips.push(xVerhaeltnis);
  chart.data.datasets[0].data.push(xLuft);
  chart.update();
  chart.data.datasets[1].data.push(xStrecke);
  chart.update();
}
// Timer

    var startMinute;
    var once;
    if (localStorage.getItem("once")!=null) {
      once = localStorage.getItem("once");
    }
    else {
      once = false;
    }
    function startTimer() {
      if(numberOfValues == 1) {
        var startDate = new Date();
        var startTime = startDate.getMinutes();
        return startTime;
      }
    }
    if(numberOfValues == 1 && once==false) {
      startMinute = startTimer(); 
      localStorage.setItem("startMinute",startMinute);
      once = true;
      localStorage.setItem("once",once);
    } else if (numberOfValues == 1 && once==true) {
      startMinute = localStorage.getItem("startMinute");
    } else if (numberOfValues > 1) {
      startMinute = localStorage.getItem("startMinute");
    }
    console.log(numberOfValues + "," + localStorage.getItem("startMinute") +","+once);
    const countTime = setInterval(() => {
      let currentDate = new Date();
      if ((currentDate.getMinutes() == (parseInt(localStorage.getItem("startMinute")) +30)%60 || currentDate.getMinutes() == parseInt(localStorage.getItem("startMinute")))
         && currentDate.getSeconds() == 0) {
      alert("Neue Wetterdaten hinfügen");
      }
    },500);
  






