<script src= <?php echo site_url("scripts/Chart.min.js")?> ></script>
<div class="container top-bottom-space">

<?php if($is_admin): ?>
    <h1><?php echo $heading ?>  
	    <span class=" col-md-3 pull-right play">
	    	<form  method = "post" action = <?php echo site_url("insights")?> role="form">
		    <div class="input-group">
		    	<select class="form-control" name="month">
		    		<option value="Jan">Jan</option>
		    		<option value="Feb">Feb</option>
		    		<option value="Mar">Mar</option>
		    		<option value="Apr">Apr</option>
		    		<option value="May">May</option>
		    		<option value="Jun">Jun</option>
		    		<option value="Jul">Jul</option>
		    		<option value="Aug">Aug</option>
		    		<option value="Sep">Sep</option>
		    		<option value="Oct">Oct</option>
		    		<option value="Nov">Nov</option>
		    		<option value="Dec">Dec</option>
		    	</select>
	      		<span class="input-group-btn"><button class="btn btn-primary btn" type="submit">Get Stats</button></span>
	    	</div>

	    </span>    
    </h1>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<h3 class="text-center"> Monthly Orders For <?php echo $month?></h3>
	  			<canvas id='sales_chart'></canvas>	  			
	  			<h4 class="text-center">Total Num Orders 	: <?php echo $num_orders?> </h4>
	  			<h4 class="text-center">Total Products 	: <?php echo $total_products?> </h4>
				<h4 class="text-center">Avg Order per Day 	: <?php echo ($num_orders /count($dates)) ?> </h4>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center"> Monthly Revenue For <?php echo $month?></h3>
  				<canvas id='revenue_chart'></canvas>
	  			<h4 class="text-center">Total Revenue 	: <?php echo $total_revenue?> </h4>
				<h4 class="text-center">Avg Revenue per Day 	: <?php echo ($total_revenue /count($dates)) ?> </h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center"> COD/Online </h3>
  				<canvas id='payment_chart'></canvas>
			</div>
		</div>
<?php endif; ?>		
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center"> War of the States </h3>
  				<canvas id='states_chart'></canvas>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center"> War of the Games </h3>
  				<canvas id='game_sales_chart'></canvas>
			</div>
		</div>		
	</div>
</div>
<script type="text/javascript">	
	var revenue_data = {
    labels: <?php echo json_encode($dates)?>,
    datasets: 
    [
        {
            label: "My First dataset",
            fillColor: "#09f",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: <?php echo json_encode($revenue_data)?>
        }
    ]
	};

	var monthly_sales_data = {
    labels: <?php echo json_encode($dates)?>,
    datasets: 
    [
        {
            label: "My First dataset",
            fillColor: "#09f",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: <?php echo json_encode($sales_data)?>
        }
    ]
	};

	var states_data = {
    labels: <?php echo json_encode($states)?>,
    datasets: 
    [
        {
            label: "My First dataset",
            fillColor: "#09f",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: <?php echo json_encode($states_sales)?>
        }
    ]
	};

	var payment_data = [
				{
					value: <?php echo $cod_orders?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Cash On Delivery"
				},
				{
					value: <?php echo $online_orders?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Online"
				}
			];


	var game_sales_data = {
    labels: <?php echo json_encode($all_games, true) ?>,
    datasets: [
        {
            label: "My First dataset",
            fillColor: "#09f",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: <?php echo json_encode($game_sales_data)?>
        }
    ]
};


<?php if($is_admin): ?>
    var sales_canvas = document.getElementById("sales_chart").getContext("2d");
    var sale_line_chart = new Chart(sales_canvas).Line(monthly_sales_data, { scaleFontColor: "#fff", bezierCurve : false, responsive : true,datasetFill : false });

	var revenue_canvas = document.getElementById("revenue_chart").getContext("2d");        
    var sale_line_chart = new Chart(revenue_canvas).Bar(revenue_data, { scaleFontColor: "#fff", bezierCurve : false, responsive : true,datasetFill : false });

	var payment_canvas = document.getElementById("payment_chart").getContext("2d");        
    var sale_line_chart = new Chart(payment_canvas).Pie(payment_data, { scaleFontColor: "#fff", bezierCurve : false, responsive : true, datasetFill : false });
<?php endif; ?>

	var states_canvas = document.getElementById("states_chart").getContext("2d");        
    var states_data_chart = new Chart(states_canvas).Bar(states_data, { scaleFontColor: "#fff", bezierCurve : false, responsive : true, datasetFill : false });

    var game_sales_canvas = document.getElementById("game_sales_chart").getContext("2d");
    var game_sales_line_chart = new Chart(game_sales_canvas).Bar(game_sales_data, { scaleFontColor: "#fff", bezierCurve : false, responsive : true,datasetFill : false });

</script>
