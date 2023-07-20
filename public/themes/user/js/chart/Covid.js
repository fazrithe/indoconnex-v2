/*!
* Start Bootstrap - Simple Sidebar v6.0.3 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// COVID DATA SAMPLE //
// Covid Case
var start = new Date("02/01/2021");
var end = new Date("02/12/2021");
var loop = new Date(start);
while(loop <= end){
  //  console.log(loop.getFullYear() +'-'+ loop.getDate());           
   var date_ = loop.getFullYear() +'-'+ loop.getDate();
   
   console.log('"'+date_+'",');
   var date = '"'+date_+'",';
   var newDate = loop.setDate(loop.getDate() + 1);
   loop = new Date(newDate);
}
// console.log(date);
// For drawing the lines
// var date_new = array(date_);
// var date = date_new;
// var date = [date__]
var date = ['January-2021','February-2021','March-2021','April-2021','May-2021','June-2021','July-2021','August-2021','September-2021','October-2021','November-2021','December-2021'];
var textName = "Total Coronavirus Cases";
var africa = [86,114,106,106,107,111,133,221,783,2478,2478,2478,2478];
var asia = [282,350,411,502,635,809,947,1402,3700,5267,2478,2478,2478];
var europe = [168,170,178,190,203,276,408,547,675,734,2478,2478,2478];
var latinAmerica = [40,20,10,16,24,38,74,167,508,784,2478,2478,2478];
var northAmerica = [6,3,2,2,7,26,82,172,312,433,2478,2478,2478];

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: date,
    datasets: [
      { 
        data: africa,
        label: "Africa",
        borderColor: "#3e95cd",
        fill: false
      },
      { 
        data: asia,
        label: "Asia",
        borderColor: "#8e5ea2",
        fill: false
      },
      { 
        data: europe,
        label: "Europe",
        borderColor: "#3cba9f",
        fill: false
      },
      { 
        data: latinAmerica,
        label: "Latin America",
        borderColor: "#e8c3b9",
        fill: false
      },
      { 
        data: northAmerica,
        label: "North America",
        borderColor: "#c45850",
        fill: false
      }
    ]
  }
});
