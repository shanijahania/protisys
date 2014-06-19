	<div class="row-fluid">
		<div class="">
			
			<div class="listing_head clearfix">
				<?php if(action_allowed('products', 'add')){?>
				<div class="listing_add">
					<a href="<?php echo site_url('admin/products/add_products'); ?>" class="btn btn-success btn-small pull-right"><i class="icon-plus"></i>New Product</a>	
				</div>
				<?php } ?>	
				<div><?php echo $pagination;?></div>
			</div>
			
			<table class="clearfix table table-striped table-bordered" id="dt_d">
				<thead>
					<tr>
						<th>No.</th>
							<?php foreach ($fields as $field => $label) { ?>
							<th <?php if($sort_column == $field) echo "class=sorting_$sort_by";?>>
								<?php echo anchor($uri_string.'&sort_column='.$field.'&sort_by='.(($sort_by == 'asc' && $sort_column == $field) ? 'desc' : 'asc'), $label);?>
							</th>
							<?php }?>
						<th>Product Price</th>
						<th>Location</th>	
						<th>Stock</th>	
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$num = 0; if(isset($products_records)) :foreach($products_records as $row): $num++;
					?>
					<tr>
						<td><?php echo $num;?></td>
						<td><?php echo $row->product_name; ?></td>
						<td><?php echo $row->product_price; ?></td>
						<td><?php echo $row->product_location == 'usa' ? 'USA' : 'Ecuador'; ?></td>
						<td><?php echo $row->product_stock ; ?></td>
						<td><?php echo $row->is_active == 0 ? 'In Active' : 'Active'; ?></td>
						<!-- <td><?php echo date('d-m-Y H:i:s' , strtotime($row->modified_at)); ?></td> -->
						<td>
							<a href="<?php echo site_url('admin/products/show_product/'.$row->product_id.'/'.encode_id($row->product_id)); ?>" class="btn btn-primary btn-minier" title="View">View</a>
							<?php if(action_allowed('products', 'edit')){?>
								<a href="<?php echo site_url('admin/products/edit_products/'.$row->product_id.'/'.encode_id($row->product_id)); ?>" class="btn btn-minier btn-yellow" title="Edit">Edit</a>
							<?php }?>
							<?php if(action_allowed('products', 'delete')){?>
							<a href="#" class="delete btn btn-danger btn-minier" id="<?php echo encode_ajax_id($row->product_id); ?>" title="Delete">Delete</a>
							<?php }?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
					<td colspan="12">No record found</td>
			<?php endif; ?>
		</tbody>
	</table>
</div>
</div>
<script src="<?php echo base_url();?>assets/js/products_list.js"></script>