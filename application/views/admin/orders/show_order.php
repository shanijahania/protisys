<div class="row-fluid">
	<div class="">
		<div class="row-fluid">
			<div class=" record_content">
				<fieldset>
					<legend>Customer Info</legend>
					<p class="clearfix">
						<span class="span2"><strong>Name:</strong></span>
						<span class="span8"><?php echo $orders_record->customer_name;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Surname:</strong></span>
						<span class="span8"><?php echo $orders_record->customer_surname;?></span>
					</p>
					
					<p class="clearfix">
						<span class="span2"><strong>Email:</strong></span>
						<span class="span8"><?php echo $orders_record->customer_email;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Mobile:</strong></span>
						<span class="span8"><?php echo $orders_record->customer_phone;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Postcode:</strong></span>
						<span class="span8"><?php echo $orders_record->customer_postcode;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Address:</strong></span>
						<span class="span8"><?php echo $orders_record->customer_address;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Order Status:</strong></span>
						<span class="span8"><?php echo $orders_record->status;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Create Date:</strong></span>
						<span class="span8"><?php echo date("F j, Y, g:i a", strtotime($orders_record->created));?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Last Modified:</strong></span>
						<span class="span8"><?php echo date("F j, Y, g:i a", strtotime($orders_record->modified));?></span>
					</p>
					
				</fieldset>
				<fieldset>
					<legend>Product Info</legend>
					<p class="clearfix">
						<span class="span2"><strong>Product Name:</strong></span>
						<span class="span8"><?php echo $orders_record->p_name;?></span>
					</p>
					<p class="clearfix">
						<span class="span2"><strong>Product Price:</strong></span>
						<span class="span8"><?php echo number_format($orders_record->p_price);?></span>
					</p>
				</fieldset>
				<!-- <p class="span12">
					<a class="btn" href="<?php echo site_url('admin/orders'); ?>"><i class="icon-reply icon-2x icon-only"></i> All Orders</a>
					<?php if(action_allowed('orders', 'edit')){?>
					<a class="btn btn-yellow" href="<?php echo site_url('admin/orders/edit_orders/'.$orders_record->id.'/'.encode_id($orders_record->id)); ?>"><i class="icon-edit icon-2x icon-only"></i> Edit</a>
					<?php } ?>
				</p> -->
			</div>
		</div>
	</div>
</div>