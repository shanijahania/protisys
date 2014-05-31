<div class="row-fluid">
	<div class="">
		<div class="row-fluid">
			<div class="">
			<p>
				<span class="span3"><strong>Product Name :</strong></span>
				<span class="span7"><?php echo $products_records->product_name;?></span>
			</p>
			<p>
				<span class="span3"><strong>Product Price :</strong></span>
				<span class="span7"><?php echo $products_records->product_price;?></span>
			</p>
			<p>
				<span class="span3"><strong>Description :</strong></span>
				<span class="span7"><?php echo $products_records->product_desc;?></span>
			</p>
			<p>
				<span class="span3"><strong>Status :</strong></span>
				<span class="span7"><?php echo $products_records->is_active == 1 ? 'Active' : 'In Active';?></span>
			</p>
			<p>
				<span class="span3"><strong>Create Date:</strong></span>
				<span class="span7"><?php echo date("F j, Y, g:i a", strtotime($products_records->created_at));?></span>
			</p>
			<p>
				<span class="span3"><strong>Last Modified:</strong></span>
				<span class="span7"><?php echo date("F j, Y, g:i a", strtotime($products_records->modified_at));?></span>
			</p>
			<p class="span12">
				<a class="btn" href="<?php echo site_url('admin/products'); ?>"><i class="icon-reply icon-2x icon-only"></i> All Products</a>
				<?php if(action_allowed('products', 'edit')){?>
				<a class="btn btn-yellow" href="<?php echo site_url('admin/products/edit_products/'.$products_records->product_id.'/'.encode_id($products_records->product_id)); ?>"><i class="icon-edit icon-2x icon-only"></i> Edit</a>
				<?php }?>
			</p>
			</div>
		</div>
	</div>
</div>