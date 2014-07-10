<div class="row-fluid">
	<div class="span10">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="smaller">View your order details</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form action="#" method="post">
					<input type="hidden" name="order_id" value="<?php echo $order_data->order_id;?>">
					<input type="hidden" name="payment_type" value="<?php echo $order_data->payment_type;?>">
						<fieldset>
							<legend>Customer Info</legend>
							<p><span class="span3"><strong>Customer First Name:</strong></span> <span class="span6"><?php echo $order_data->first_name;?></span></p>
							<p><span class="span3"><strong>Surname:</strong></span> <span class="span6"><?php echo $order_data->surname;?></span></p>
							<p><span class="span3"><strong>Email:</strong></span> <span class="span6"><?php echo $order_data->email;?></span></p>
							<p><span class="span3"><strong>Phone:</strong></span> <span class="span6"><?php echo $order_data->phone;?></span></p>
							<p><span class="span3"><strong>Postcode:</strong></span> <span class="span6"><?php echo $order_data->postcode;?></span></p>
							<p><span class="span3"><strong>Address:</strong></span> <span class="span6"><?php echo $order_data->address;?></span></p>
						</fieldset>
						<fieldset>
							<legend>Order Info</legend>
							<p><span class="span3"><strong>Products Name:</strong></span> <span class="span6"><?php echo $order_products[0]->p_name;?></span></p>
							<p><span class="span3"><strong>Quantity:</strong></span> <span class="span6"><?php echo $order_data->total_qty;?></span></p>
							<p><span class="span3"><strong>Product Price:</strong></span> <span class="span6"><?php echo $order_products[0]->p_price;?></span></p>
							<p><span class="span3"><strong>Commission:</strong></span> <span class="span6"><?php echo $order_data->total_commission;?></span></p>
							<p><span class="span3"><strong>Shipment Fee:</strong></span> <span class="span6"><?php echo $order_data->shipment;?></span></p>
							<p><span class="span3"><strong>Payment Method:</strong></span> <span class="span6"><?php echo $order_data->payment_type;?></span></p>
							<p><span class="span3"><strong>Order Total:</strong></span> <span class="span6"><?php echo $order_data->total_amount;?></span></p>
						</fieldset>
						
						<p>							
							<button type="button" id="cancel_order" class="btn btn-small" id="cancel">Cancel Order</button>
							<button type="button" id="save_order" class="btn btn-info btn-small" >Save and Process later</button>
							<button type="button" id="edit_order" class="btn btn-danger btn-small">Edit Details</button>
							<button type="button" id="confirm_order" class="btn btn-success btn-small tooltip-info">Confirm Order</button>
						</p>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	var order_id 		= "<?php echo $order_data->order_id;?>";
	var payment_type 	= "<?php echo $order_data->payment_type;?>";
	var base_url 		= "<?php echo base_url(); ?>";
	var uri 			= "?order_id="+order_id+"&payment="+payment_type;

	$(document).ready(function(){
		$('#confirm_order').click(function(){
			window.location = base_url+"admin/orders/process_order"+uri;
		});
		$('#edit_order').click(function(){
			window.location = base_url+"admin/orders/edit_orders"+uri;
		});
		$('#save_order').click(function(){
			window.location = base_url+"admin/orders/save_order"+uri;
		});
		$('#cancel_order').click(function(){
			bootbox.confirm('Are you sure want to delete this order?', {'verify':true}, function(r)
	        {
	            if(r)
	            {
	                window.location = base_url+"admin/orders/delete_order"+uri;
	            }
	            else
	            {
	                return false;
	            }
	        });
		});
	});
</script>