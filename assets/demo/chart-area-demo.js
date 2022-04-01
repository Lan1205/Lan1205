// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var xValues = [];
var tooltips = [];

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: xValues,
    zustand: tooltips,
    datasets: [{ 
      label: "Lieferzeit",
      backgroundColor: [
        'rgb(206, 224, 229)',
      ],
      borderColor: [
        'rgb(124, 154, 50)',
      ],
      borderWidth: 2,     
      fill: false,
      data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
    }],
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
    request.open('GET', './statistik.php', true);
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


var ctxP = document.getElementById("labelChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
  type: 'pie',
  data: {
    labels: ["Cold(H/E)", "Medium(G/D)", "Hot(I/F),", "Intermediate(H+/I+)","Dry Wet(T/T)","Heavy Wet(A/A)"],
    datasets: [{
      data: [1,2,3,4],
      backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#7BB94F", "#9D4FB9", "#1f68d8"],
      hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#1f68d8"]
    }]
  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
      labels: {
        padding: 20,
        boxWidth: 10,
      }
    },
    plugins: {
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
