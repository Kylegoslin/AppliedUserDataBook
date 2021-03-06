
<!doctype html>
<html>

<head>
	<title>Scatter Chart</title>
	<script src="https://www.chartjs.org/dist/2.8.0/Chart.min.js"></script>
	<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>
	<div style="width:75%">
		<canvas id="canvas"></canvas>
	</div>
	<button id="randomizeData">Randomize Data</button>
	<script>
		var color = Chart.helpers.color;
		function generateData() {
			var data = [];
			for (var i = 0; i < 7; i++) {
				data.push({
					x: '2019-08-26 19:45:00',
					y: randomScalingFactor()
				});
			}
			return data;
		}

		var scatterChartData = {
			datasets: [{
				label: 'My First dataset',
				borderColor: window.chartColors.red,
				backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
				data: generateData()
			}, {
				label: 'My Second dataset',
				borderColor: window.chartColors.blue,
				backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
				data: generateData()
			}]
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myScatter = Chart.Scatter(ctx, {
				data: scatterChartData,
				options: {
					title: {
						display: true,
						text: 'Chart.js Scatter Chart'
					},
				}
			});
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			scatterChartData.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return {
						x: randomScalingFactor(),
						y: randomScalingFactor()
					};
				});
			});
			window.myScatter.update();
		});
	</script>
</body>

</html>
