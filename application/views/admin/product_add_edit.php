<div class="container top-bottom-space">
    <h1> Product Add/Edit </h1>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<form class='form-horizontal'>
				<div class='form-group' >
					
						<div class='col-md-2'>
							<select class= "form-control " name="type">
								<option value = "tshirt">Tshirt</option>
								<option value = "hoodie">Hoodie</option>
							</select>
						</div>
						<div class="col-md-2">
							<input class='form-control' type="text" placeholder="Game Name" name="game_name"></input>		
						</div>
						<div class='col-md-3'>
							<input class='form-control' type="text" placeholder="Product Name" name="product_name"></input>		
						</div>
						<div class='col-md-5'>
							<input class='form-control' type="text" placeholder="URL Keywords" name="url"></input>		
						</div>
					
				</div>
				<div class='form-group '>
					
						<div class="col-md-12">
							<textarea class='form-control' name='desc' placeholder='Product Description'></textarea>		
						</div>
					
				</div>
				<div class='form-group '>
					
						<div class="col-md-4">
							<input class='form-control' type="text" placeholder="Image path with '/'" name="image_path"></input>
						</div>
						<div class="col-md-2">
							<input class='form-control' type="number" placeholder="Price" name="price"></input>
						</div>
						<div class='col-md-1'>
							<input class='form-control' type="number" placeholder="Small Qty" name="s_qty"></input>
						</div>
						<div class='col-md-1'>
							<input class='form-control' type="number" placeholder="Medium Qty" name="m_qty"></input>
						</div>
						<div class='col-md-1'>
							<input class='form-control' type="number" placeholder="Large Qty" name="l_qty"></input>
						</div>
						<div class='col-md-1'>
							<input class='form-control' type="number" placeholder="XL Qty" name="xl_qty"></input>
						</div>				
				</div>				
			</div>			
		</div>		
	</div>
	<button class='btn btn-primary' type="submit"> Add Product </button>
	</form>
</div>
