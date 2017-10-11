<div class="row dashboard-content">

	<div class="col-lg-6 col-md-6">

		<div class="panel panel-default">

			<div class="panel-heading">
				<h4 class="title">Tickets Status</h4>
			</div>

			<div class="panel-body">
				<div id="canvas-holder-ticket">
		        	<canvas id="chart-area-ticket" />
				</div>
			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    {{ count($newTickets) }},
                    {{ count($assignedTickets) }},
                    {{ count($inProgressTickets) }},
                   	{{ count($pendingTickets) }},
                    {{ count($resolvedTickets) }}
                    // randomScalingFactor(),
                ],
                backgroundColor: [
                    window.chartColors.orange,
                    window.chartColors.grey,
                    window.chartColors.blue,
                    window.chartColors.yellow,
                    window.chartColors.green,
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "New",
                "Assigned",
                "In Progress",
                "Pending",
                "Resolved"
            ]
        },
        options: {
            responsive: true
        }
    };
    window.onload = function() {
        var ctx = document.getElementById("chart-area-ticket").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };
</script>