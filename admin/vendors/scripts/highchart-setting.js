// chart 1
Highcharts.chart('chart1', {
	title: {
		text: 'Employment Growth by Sector, 2014-2020'
	},
	subtitle: {
		text: 'Chart with dummy data'
	},
	yAxis: {
		title: {
			text: 'Number of Employees'
		}
	},
	chart: {
		type: 'spline',
	},
	plotOptions: {
		series: {
			label: {
				connectorAllowed: false
			},
			pointStart: 2014
		},
		spline: {
			marker: {
				enabled: false
			}
		}
	},
	series: [{
		name: 'Installation',
		data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
	}, {
		name: 'Manufacturing',
		data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
	}, {
		name: 'Sales & Distribution',
		data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
	}, {
		name: 'Project Development',
		data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
	}, {
		name: 'Other',
		data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
	}],
	responsive: {
		rules: [{
			condition: {
				maxWidth: 500
			}
		}]
	}
});

// chart 5
Highcharts.chart('chart2', {
	title: {
		text: 'Pie point CSS'
	},
	// xAxis: {
	// 	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	// },
	series: [{
		type: 'pie',
		allowPointSelect: true,
		keys: ['name', 'y', 'selected', 'sliced'],
		data: [
		['Apples', 29.9, false],
		['Pears', 71.5, false],
		['Oranges', 106.4, false],
		['Plums', 129.2, false],
		['Bananas', 144.0, false],
		['Peaches', 176.0, false],
		['Prunes', 135.6, true, true],
		['Avocados', 148.5, false]
		],
		showInLegend: true
	}]
});

// chart 6
Highcharts.chart('chart3', {
	chart: {
		type: 'pie',
		options3d: {
			enabled: true,
			alpha: 45
		}
	},
	title: {
		text: 'Contents of Highsoft\'s weekly fruit delivery'
	},
	subtitle: {
		text: '3D donut in Highcharts'
	},
	plotOptions: {
		pie: {
			innerSize: 100,
			depth: 45
		}
	},
	series: [{
		name: 'Delivered amount',
		data: [
		['Bananas', 8],
		['Kiwi', 3],
		['Mixed nuts', 1],
		['Oranges', 6],
		['Apples', 8],
		['Pears', 4],
		['Clementines', 4],
		['Reddish (bag)', 1],
		['Grapes (bunch)', 1]
		]
	}]
});