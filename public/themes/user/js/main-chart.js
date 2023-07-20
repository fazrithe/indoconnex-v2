/*
 * PT. IMAJIKU CIPTA MEDIA
 * Copyright 2019-2020 IMAJIKU.
 * USE FOR GLOBAL FUNCTIONS
 */



 /* document ready */
 $(document).ready(function() {


 	/* Column Chart */
 	var columnId = document.getElementById("chart-column");

 	var data = {
 		labels: ['Variable'],
 		datasets: [{
 			label: "Lorem Ipsum 1",
 			data: [50],
 			backgroundColor: '#6686fa'
 		}, {
 			label: "Lorem Ipsum Lorem Ipsum 2",
 			data: [14],
 			backgroundColor: '#10c892'
 		},
 		{
 			label: "Lorem 3",
 			data: [8],
 			backgroundColor: '#8365c0'
 		},
 		{
 			label: "Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum 4",
 			data: [20],
 			backgroundColor: '#ff3161'
 		},
 		{
 			label: "Lorem Ipsum Lorem  Lorem Ipsum 5",
 			data: [14],
 			backgroundColor: '#ffb300'
 		}]

 	};

 	var optionsBar = { 
 		legend: {
 			position: 'right'
 		}
 	};

 	if ($(columnId).length > 0) {
 		var myColumnChart = new Chart(columnId, {
 			type: 'bar',
 			data: data,
 			options: optionsBar
 		});
 	}else{
 		var myColumnChart = null;
 	}


 	/* Column Multi Chart */
 	var columnMultiId = document.getElementById("chart-column-multi");

 	var data = {
 		labels: ['Variable 1','Variable 2','Variable 3'],
 		datasets: [{
 			label: "Lorem Ipsum 1",
 			data: [50,10,20],
 			backgroundColor: '#6686fa'
 		}, {
 			label: "Lorem Ipsum Lorem Ipsum 2",
 			data: [14,50,10],
 			backgroundColor: '#10c892'
 		},
 		{
 			label: "Lorem 3",
 			data: [8,40,70],
 			backgroundColor: '#8365c0'
 		},
 		{
 			label: "Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum 4",
 			data: [20,20,60],
 			backgroundColor: '#ff3161'
 		},
 		{
 			label: "Lorem Ipsum 5",
 			data: [14,10,20],
 			backgroundColor: '#ffb300'
 		}]

 	};

 	var optionsMultiBar = { 
 		legend: {
 			position: 'right'
 		}
 	};

 	if ($(columnMultiId).length > 0) {
 		var myColumnChartMulti = new Chart(columnMultiId, {
 			type: 'bar',
 			data: data,
 			options: optionsMultiBar
 		});
 	}else{
 		var myColumnChartMulti = null;
 	}


 	/* Column Line */
 	var lineId = document.getElementById("chart-line");

 	var data = {
 		labels: ['January','February','March','April','May','June'],
 		datasets: [{
 			label: "Sangat memuaskan",
 			data: [10,25,50,25,30,45],
 			backgroundColor: '#6686fa'
 		}]

 	};

 	var optionsLine = { 
 		legend: {
 			position: 'right'
 		}
 	};

 	if ($(lineId).length > 0) {
 		var myLineChart = new Chart(lineId, {
 			type: 'line',
 			data: data,
 			options: optionsLine
 		});
 	}else{
 		var myLineChart = null;
 	}

 	/* Chart Multi Line */
 	var lineMultiId = document.getElementById("chart-multi-line");

 	var data = {
 		labels: ['January','February','March','April','May','June'],
 		datasets: [{
 			label: "Sangat memuaskan",
 			data: [10,25,50,25,30,45],
 			backgroundColor: '#6686fa'
 		},
 		{
 			label: "Memuaskan",
 			data: [40,15,43,45,36,20],
 			backgroundColor: '#10c892'
 		},
 		{
 			label: "Biasa saja",
 			data: [30,20,11,19,24,40],
 			backgroundColor: '#8365c0'
 		},
 		{
 			label: "Mengecewakan",
 			data: [15,35,21,30,23,25],
 			backgroundColor: '#ff3161'
 		},
 		{
 			label: "Buruk",
 			data: [7,35,25,25,36,47],
 			backgroundColor: '#ffb300'
 		}]

 	};

 	var optionsMultiLine = { 
 		legend: {
 			position: 'right'
 		}
 	};

 	if ($(lineMultiId).length > 0) {
 		var myLineChartMulti = new Chart(lineMultiId, {
 			type: 'line',
 			data: data,
 			options: optionsMultiLine
 		});
 	}else{
 		myLineChartMulti = null;
 	}

 	/* Chart Pie */
 	var pieId = document.getElementById("chart-pie");

 	var data = {
 		labels: [
 		"Saudi Arabia",
 		"Russia",
 		"Iraq",
 		"United Arab Emirates",
 		"Canada"
 		],
 		datasets: [
 		{
 			data: [133.3, 86.2, 52.2, 51.2, 50.2],
 			backgroundColor: [
 			"#6686fa",
 			"#10c892",
 			"#8365c0",
 			"#ff3161",
 			"#ffb300"
 			]
 		}]
 	};

 	var optionsPie = { 
 		legend: {
 			position: 'right'
 		}
 	};


 	if ($(pieId).length > 0) {
 		var myPieChart = new Chart(pieId, {
 			type: 'pie',
 			data: data,
 			options: optionsPie
 		});
 	}else{
 		myPieChart = null;
 	}

 	/* Chart Doughnut */
 	var doughnutId = document.getElementById("chart-doughnut");

 	var data = {
 		labels: [
 		"Saudi Arabia",
 		"Russia",
 		"Iraq",
 		"United Arab Emirates",
 		"Canada"
 		],
 		datasets: [
 		{
 			data: [133.3, 86.2, 52.2, 51.2, 50.2],
 			backgroundColor: [
 			"#6686fa",
 			"#10c892",
 			"#8365c0",
 			"#ff3161",
 			"#ffb300"
 			]
 		}]
 	};

 	var optionsDoughnut = { 
 		legend: {
 			position: 'right'
 		},
 		tooltips: {
            // Disable the on-canvas tooltip
            enabled: false,
            
            custom: function(tooltipModel) {
                // Tooltip Element
                var tooltipEl = document.getElementById('chartjs-tooltip');

                // Create element on first render
                if (!tooltipEl) {
                	tooltipEl = document.createElement('div');
                	tooltipEl.id = 'chartjs-tooltip';
                	tooltipEl.innerHTML = '<table></table>';
                	document.body.appendChild(tooltipEl);
                }

                // Hide if no tooltip
                if (tooltipModel.opacity === 0) {
                	tooltipEl.style.opacity = 0;
                	return;
                }

                // Set caret Position
                tooltipEl.classList.remove('above', 'below', 'no-transform');
                if (tooltipModel.yAlign) {
                	tooltipEl.classList.add(tooltipModel.yAlign);
                } else {
                	tooltipEl.classList.add('no-transform');
                }

                function getBody(bodyItem) {
                	return bodyItem.lines;
                }

                // Set Text
                if (tooltipModel.body) {
                	var titleLines = tooltipModel.title || [];
                	var bodyLines = tooltipModel.body.map(getBody);

                	var innerHtml = '<thead>';

                	titleLines.forEach(function(title) {
                		innerHtml += '<div class="tooltip-title">' + title + '</div>';
                	});
                	innerHtml += '</thead><tbody>';

                	bodyLines.forEach(function(body, i) {
                		var colors = tooltipModel.labelColors[i];
                		var style = 'background:' + colors.backgroundColor;
                		style += '; border-color:' + colors.borderColor;
                		style += '; border-width: 2px';
                		var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                		innerHtml += '<tr><td>' + span + body + '</td></tr>';
                	});
                	innerHtml += '</tbody>';

                	var tableRoot = tooltipEl.querySelector('table');
                	tableRoot.innerHTML = innerHtml;
                }

                // `this` will be the overall tooltip
                var position = this._chart.canvas.getBoundingClientRect();

                // Display, position, and set styles for font
                tooltipEl.style.opacity = 1;
                tooltipEl.style.position = 'absolute';
                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';
                tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';
                tooltipEl.style.pointerEvents = 'none';
            }
        }
    };



    if ($(doughnutId).length > 0) {
    	var myDoughnutChart = new Chart(doughnutId, {
    		type: 'doughnut',
    		data: data,
    		options: optionsDoughnut
    	});
    }else{
    	var myDoughnutChart = null;
    }

    /* Chart Radar */
    var radarId = document.getElementById("chart-radar");

    var data = {
    	labels: [
    	"Inggris",
    	"Matematika",
    	"PPKN",
    	"Olahraga",
    	"Seni Budaya"
    	],
    	datasets: [
    	{
    		label: "Nadya",
    		data: [10,25,50,25,30],
    		backgroundColor: '#6686fa'
    	},
    	{
    		label: "Fatin",
    		data: [40,15,43,45,36],
    		backgroundColor: '#10c892'
    	},
    	{
    		label: "Bimo",
    		data: [30,20,11,19,24],
    		backgroundColor: '#8365c0'
    	},
    	{
    		label: "Alex",
    		data: [15,35,21,30,23],
    		backgroundColor: '#ff3161'
    	},
    	{
    		label: "Fikri",
    		data: [7,35,25,25,36],
    		backgroundColor: '#ffb300'
    	}]
    };

    var optionsRadar = { 
    	legend: {
    		position: 'right'
    	}
    };

    if ($(radarId).length > 0) {
    	var myRadarChart = new Chart(radarId, {
    		type: 'radar',
    		data: data,
    		options: optionsRadar
    	});
    }else{
    	var myRadarChart = null;
    }

    /* Column Stacked */

    var stackedId = document.getElementById("chart-column-stacked");

    var data = {
    	labels: ["Variable 1","Variable 2","Variable 3","Variable 4","Variable 5"],
    	datasets: [{
    		label: 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum 1',
    		backgroundColor: "#6686fa",
    		data: [12, 59, 5, 56, 58],
    	}, {
    		label: 'Lorem Ipsum Lorem Ipsum 2',
    		backgroundColor: "#10c892",
    		data: [12, 59, 5, 56, 58],
    	}, {
    		label: 'Lorem Ipsum 3',
    		backgroundColor: "#8365c0",
    		data: [12, 59, 5, 56, 58],
    	}, {
    		label: 'Lorem Ipsum Lorem Ipsum Lorem 4',
    		backgroundColor: "#ff3161",
    		data: [12, 59, 5, 56, 58],
    	}]
    };

    var options = { 
    	tooltips: {
    		displayColors: true,
    		callbacks:{
    			mode: 'x',
    		},
    	},
    	scales: {
    		xAxes: [{
    			stacked: true,
    			gridLines: {
    				display: false,
    			}
    		}],
    		yAxes: [{
    			stacked: true,
    			ticks: {
    				beginAtZero: true,
    			},
    			type: 'linear',
    		}]
    	},
    	responsive: true,
    	maintainAspectRatio: true,
    	legend: { position: 'right' }
    };

    if ($(stackedId).length > 0) {
    	var myColumnChartStacked = new Chart(stackedId, {
    		type: 'bar',
    		data: data,
    		options:options
    	});
    }else{
    	var myColumnChartStacked = null;
    }

    /* Chart Bar Horizontal*/
    var barHorizontalId = document.getElementById("chart-bar-horizontal");

    var data = {
    	labels: ['Variable'],
    	datasets: [{
    		label: "Lorem Ipsum 1",
    		data: [50],
    		backgroundColor: '#6686fa'
    	}, {
    		label: "Lorem Ipsum Lorem Ipsum 2",
    		data: [14],
    		backgroundColor: '#10c892'
    	},
    	{
    		label: "Lorem 3",
    		data: [8],
    		backgroundColor: '#8365c0'
    	},
    	{
    		label: "Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum 4",
    		data: [20],
    		backgroundColor: '#ff3161'
    	},
    	{
    		label: "Lorem Ipsum Lorem  Lorem Ipsum 5",
    		data: [14],
    		backgroundColor: '#ffb300'
    	}]

    };

    var optionsBarHorizontal = { 
    	legend: {
    		position: 'right'
    	},
    	tooltips: {
    		callbacks: {
    			label: function(tooltipItem) {
    				return "$" + Number(tooltipItem.yLabel) + " and so worth it !";
    			}
    		}
    	},
    	title: {
    		display: true,
    		text: 'Ice Cream Truck',
    		position: 'bottom'
    	}
    };


    if ($(barHorizontalId).length > 0) {
    	var myBarHorizontalChart = new Chart(barHorizontalId, {
    		type: 'horizontalBar',
    		data: data,
    		options: optionsBarHorizontal
    	});
    }else{
    	var myBarHorizontalChart = null;
    }

    /*Chart js Gauge*/
    var doughnutHalf = document.getElementById("chartjs-doughnut-half");

    var data = {
    	datasets: [{
    		data: [10, 25, 50],  
    		backgroundColor: ['rgb(255,84,84)','rgb(239,214,19)','rgb(61,204,91)'],
	          // borderColor: [ 
		         //  "#005500",
		         //  "#550000",
		         //  "#555500"
	          // ],
	          // borderWidth: 1, 
	      }],
	      labels: [   
	      'Yogyakarta',
	      'Medan',
	      'Aceh'
	      ]
	  };
	  
	  var optionsDoughnutHalf = {
	  	cutoutPercentage: 70, 
	  	rotation: Math.PI,    
	  	circumference: Math.PI,
	  	legend: {
	  		display:true, 
	  		position: 'left'
	  	}
	  };

	  if ($(doughnutHalf).length > 0) {
	  	var myDoughnutHalf = new Chart(doughnutHalf, {
	  		type: 'doughnut',
	  		data: data,
	  		options: optionsDoughnutHalf
	  	});
	  }else{
	  	var myGauge2Chart = null
	  }

	});