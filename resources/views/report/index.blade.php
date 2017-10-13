@extends('layouts.back')

@section('title')
Report
@endsection

@section('content')

	<div class="row report-content">

		<div class="col-lg-12 col-md-12">

			<div class="panel panel-default">

				<div class="panel-heading">
					<h4 class="title">Hours Spent on Tickets This Week</h4>
				</div>

				<div class="panel-body">
					<div id="canvas-holder-time">
			        	<canvas id="chart-area-time" />
					</div>
				</div>

			</div>

		</div>

	</div>

	<?php
		$data_hour = array();
		foreach ($comments as $value) {
			$hours = 0;
			foreach ($value as $item) {
				if (isset($item['time'])) {
					$hours = $hours + $item['time'];
				}
			}
			$data_hour[] = $hours;
		}

		//print_r('<pre>'); print_r($data_hour); print_r('</pre>');

		$data_user = array();
		foreach ($user_comments as $value) {
			$hours = 0;
			foreach ($value as $item) {
				if (isset($item['time'])) {
					$hours = $hours + $item['time'];
				}
			}
			$data_user[] = $hours;
			//print_r('<pre>'); print_r($value); print_r('</pre>');
		}

		//print_r('<pre>'); print_r($data_user); print_r('</pre>');
	?>

	<div class="row report-content">

		<div class="col-lg-12 col-md-12">

			<div class="panel panel-default">

				<div class="panel-heading">
					<h4 class="title">Hours Spent of Users This Week</h4>
				</div>

				<div class="panel-body">
					<div id="canvas-holder-users">
			        	<canvas id="chart-area-users" />
					</div>
				</div>

			</div>

		</div>

	</div>

	<script type="text/javascript">

		// function getFormattedMondayDate(week) {
		// 	var todayTime = new Date();
		// 	var month = todayTime.getMonth() + 1;
		// 	var year = todayTime.getFullYear();
		// 	if (week === undefined) {
		// 	    var day = todayTime.getDate() - todayTime.getDay() + 1;
		// 	} else {
		// 		if (isNaN(week)) {
		// 			var day = todayTime.getDate() - todayTime.getDay() + 1;
		// 		} else {
		// 			var day = todayTime.getDate() - todayTime.getDay() + 1 - (week * 7);
		// 		}
		// 	}
		// 	return year + "-" month + "-" + day;
		// }

		/* Hours Spent on Tickets This Week */
		var data_hour = [];
		@foreach($data_hour as $hour)
			data_hour.push( {{ $hour }} );
		@endforeach

		var barChartData = {
			labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Sat"],
			datasets: [{
				label: "Hours",
				backgroundColor: [window.chartColors.red, window.chartColors.orange, window.chartColors.yellow, window.chartColors.purple, window.chartColors.blue, window.chartColors.green],
				borderColor: window.chartColors.pink,
				borderWidth: 1,
				data: data_hour
			}]
		};

		var config_hour = {
		    type: 'bar',
		    data: barChartData,
		    options: {
	            responsive: true,
	            legend: {
	                position: 'top',
	            },
	            title: {
	                display: true,
	                text: 'Ticket Chart'
	            },
	            scales: {
	            	yAxes: [
	            		{
	            			ticks: {
	            				min: 0, // for ignoring negative step
	            				beginAtZero: true,
	            				stepSize: 5
	            			}
	            		}
	            	]
	            }
	        }
		};

		/* Hours Spent of Users This Week */
		var labels_user = [];
		@foreach($user_comments as $key => $user_comment)
			var username = "{{ App\User::find($key)->name }}";
			labels_user.push(username);
		@endforeach

		var data_user = [];
		@foreach($data_user as $hour)
			data_user.push( {{ $hour }} );
		@endforeach

		var barChartDataUser = {
			labels: labels_user,
			datasets: [{
				label: "User Hours",
				backgroundColor: window.chartColors.grey,
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: data_user
			}]
		};

		var config_user = {
		    type: 'bar',
		    data: barChartDataUser,
		    options: {
	            responsive: true,
	            legend: {
	                position: 'top',
	            },
	            title: {
	                display: true,
	                text: 'User Ticket Hours'
	            },
	            scales: {
	            	yAxes: [
	            		{
	            			ticks: {
	            				min: 0, // for ignoring negative step
	            				beginAtZero: true,
	            				stepSize: 2
	            			}
	            		}
	            	]
	            }
	        }
		};

		window.onload = function() {
			var ctx_hour = document.getElementById("chart-area-time").getContext("2d");
	        window.myBar = new Chart(ctx_hour, config_hour);

	        var ctx_user = document.getElementById("chart-area-users").getContext("2d");
	        window.userBar = new Chart(ctx_user, config_user);
	    };

	    
	</script>

@endsection

