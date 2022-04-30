<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<canvas id="line" height="100"></canvas>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-8">
				<canvas id="bar"></canvas>
			</div>
			<div class="col-4">
				<canvas id="pie"></canvas>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
	<script>

		const baseUrl = "<?php echo base_url();?>"
		const myChart = (chartType) => {
				$.ajax({
					url: baseUrl+'welcome/chart_data',
					dataType: 'json',
					method: 'get',
					success: data => {
						let chartX = []
						let chartY = []
						data.map( data => {
							chartX.push(data.month)
							chartY.push(data.sales)
						})
						const chartData = {
							labels: chartX,
							datasets: [
								{
									label: 'Sales',
									data: chartY,
									backgroundColor: ['lightcoral'],
									borderColor: ['lightcoral'],
									borderWidth: 4
								}
							]
						}
						const ctx = document.getElementById(chartType).getContext('2d')
						const config = {
							type: chartType,
							data: chartData
						}
						switch(chartType) {
							case 'pie':
								const pieColor = ['salmon','red','green','blue','aliceblue','pink','orange','gold','plum','darkcyan','wheat','silver']
								chartData.datasets[0].backgroundColor = pieColor
								chartData.datasets[0].borderColor = pieColor
								break;
							case 'bar':
								chartData.datasets[0].backgroundColor = ['skyblue']
								chartData.datasets[0].borderColor = ['skyblue']
								break;
							default :
								config.options = {
									scales: {
										y: {
											beginAtZero: true
										}
									}
								}
						}
						const chart = new Chart(ctx, config)
					}
				})
		}

		myChart('pie')
		myChart('line')
		myChart('bar')

	</script>
</body>
</html>
