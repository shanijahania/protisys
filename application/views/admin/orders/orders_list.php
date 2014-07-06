
<div class="row-fluid">
	<div class="">
		<div class="listing_head">
			<div id="nav-search">
				<form class="form-search" method="GET" action="<?php echo current_url();?>">
					<span class="input-icon">
						<input autocomplete="off" name="s" id="" type="text" class="input-small" placeholder="Search ..." value="<?php echo $s;?>" />
						<i id="nav-search-icon" class="icon-search"></i>
						<div class="btn-group">
							<button class="btn btn-small btn-primary"> <i class="icon-search"></i> Search orders</button>
							<a href="?" class="btn btn-small btn-primary"><i class="icon-remove"></i></a>
						</div>
					</span>
				</form>
			</div><!--#nav-search-->
			<?php if(action_allowed('orders', 'add')){?>
			<div class="listing_add">
				<a href="<?php echo site_url('admin/orders/add_orders'); ?>" class="btn btn-success btn-small pull-right"><i class="icon-plus"></i>New Order</a>	
			</div>
			<?php } ?>
			<div><?php echo $pagination;?></div>
		</div>

		<table class="table table-striped table-bordered" id="dt_d">
			<thead>
				<tr>
					<th>No.</th>
					<th>First Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$num = 0; if(isset($orders_records)) :foreach($orders_records as $row): $num++;
				?>
				<tr>
					<td><?=$num?></td>
					<td><?php echo $row->first_name; ?></td>
					<td><?php echo $row->email; ?></td>
					<td><?php echo $row->phone; ?></td>
					<td><?php echo $row->address; ?></td>
					<td><?php echo $row->status; ?></td>
					<td>
						<a href="<?php echo site_url('admin/orders/show_order/'.$row->order_id.'/'.encode_id($row->order_id)); ?>" class="btn btn-primary btn-minier" title="View">View</a>
						<?php if(action_allowed('orders', 'edit')){?>
						<a href="<?php echo site_url('admin/orders/edit_orders/'.$row->order_id.'/'.encode_id($row->order_id)); ?>" class="btn btn-minier btn-yellow" title="Edit">Edit</a>
						<?php }?>
						<?php if(action_allowed('orders', 'delete')){?>
						<a href="#" class="delete btn btn-danger btn-minier" id="<?php echo encode_ajax_id($row->order_id); ?>" title="Delete">Delete</a>
						<?php }?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php else : ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url();?>assets/js/orders_list.js"></script>