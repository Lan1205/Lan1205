
var xValues = [];
var tooltips = [];
var pageWidth = document.documentElement.scrollWidth;
var pageHeight= document.documentElement.scrollHeight;

var chart = new Chart("Lieferzeit", {
  type: "line",
  data: {
    labels: xValues,
    zustand: tooltips,
    datasets: [{ 
      label: "Lieferzeit",
      backgroundColor: [
        "green",
      ],
      borderColor: [
        'rgb(124, 154, 50)',
      ],
      borderWidth: 2,
      data: [],
     
      fill: false
    }]
  },
  options: {
    legend: {display: true},
    maintainAspectRatio: false,
    scales: {
      
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

window.onload = function()
{
  var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == XMLHttpRequest.DONE) 
        {
          console.log(this.responseText);
          var dsgetrennt = this.responseText.split("?");
          var counterList = this.responseText.split("%")[1];
          var result= counterList.split(","); 
          var allgetrennt;
          for (i = 0; i < dsgetrennt.length - 1; i++)
          {
            allgetrennt = dsgetrennt[i].split("!");
            fetchChartData(JSON.parse(allgetrennt[0]), JSON.parse(allgetrennt[1]), JSON.parse(allgetrennt[2]));
          }
          //for Pie Chart 
          for(var i=0 ; i< 6; i++)
          {
            myPieChart.data.datasets[0].data.push(result[i]);
          }
          myPieChart.update();

        }

    };
    request.open('GET', './statistikLogic.php', true);
    request.send(); 
}

function fetchChartData(reifen, start, ende)
{
  xValues.push(reifen); 

  minutenStart= start.substr(14,2);
  hoursStart=  start.substr(11,2);

  minutenEnd= ende.substr(14,2); 
  hoursEnd=  ende.substr(11,2); 
  
  if(minutenStart > minutenEnd )
  {
    hoursEnd=hoursEnd-1; 
    minutenEnd=parseInt(minutenEnd)+60; 
  }

  var diff_h; 
  var diff_m; 

  diff_h= hoursEnd-hoursStart; 
  diff_m= minutenEnd- minutenStart;  

  data_graph= diff_h*60 + diff_m; 

  chart.data.datasets[0].data.push(data_graph);
  chart.update();

}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++

var ctxP = document.getElementById("labelChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  type: 'pie',
  data: {
    labels: ["Cold", "Medium", "Hot,", "Intermediate","Dry Wet","Heavy Wet"],
    datasets: [{
      data: [],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#7BB94F", "#9D4FB9", "#1f68d8"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#1f68d8"]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'right',
        labels: {
          padding: 20,
          boxWidth: 30,
        }
      },
      datalabels: {
        formatter: (value, ctx) => {
          let sum = 0;
          let dataArr = ctx.chart.data.datasets[0].data;
          dataArr.map(data => {
            sum += data;
          });
          let percentage = (value * 100 / sum).toFixed(2) + "%";
          return percentage;
        },
        color: 'white',
        labels: {
          title: {
            font: {
              size: '16'
            }
          }
        }
      }
    }
  }
});


function myFunction(x) {
  if (x.matches) { // If media query matches
    myPieChart.options.plugins.legend.labels.padding = 10;
    myPieChart.options.plugins.legend.labels.boxWidth = 20;
  } else {
    myPieChart.options.plugins.legend.labels.padding = 20;
    myPieChart.options.plugins.legend.labels.boxWidth = 30;
  }
}

var x = window.matchMedia("(max-width: 600px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes 
