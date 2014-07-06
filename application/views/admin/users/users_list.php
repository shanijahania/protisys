	<div class="row-fluid">
		<div class="span10">
			<div class="listing_head">
				<div id="nav-search">
					<form class="form-search" method="GET" action="<?php echo current_url();?>">
						<span class="input-icon">
							<input autocomplete="off" name="s" id="" type="text" class="input-small" placeholder="Search ..." value="<?php echo $s;?>" />
							<i id="nav-search-icon" class="icon-search"></i>
							<div class="btn-group">
								<button class="btn btn-small btn-primary"> <i class="icon-search"></i> Search</button>
								<a href="?" class="btn btn-small btn-primary"><i class="icon-remove"></i></a>
							</div>
						</span>
					</form>
				</div><!--#nav-search-->
				<?php if(action_allowed('users', 'add')){?>
				<div class="listing_add">
					<a href="<?php echo site_url('admin/users/add_users'); ?>" class="btn btn-success btn-small pull-right"><i class="icon-plus"></i>New Users</a>	
				</div>
				<?php } ?>
				<div><?php echo $pagination;?></div>
			</div>
			<table class="table table-striped table-bordered" id="dt_d">
				<thead>
					<tr>
						<th>No.</th>
						<?php foreach ($fields as $field => $label) { ?>
						<th <?php if($sort_column == $field) echo "class=sorting_$sort_by";?>>
							<?php echo anchor($uri_string.'&sort_column='.$field.'&sort_by='.(($sort_by == 'asc' && $sort_column == $field) ? 'desc' : 'asc'), $label);?>
						</th>
						<?php }?>
						<th>Access</th>
						<th>Is Active</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$num = 0; if(isset($users_records)) :foreach($users_records as $row): $num++;
					?>
					<tr>
						<td><?php echo $num;?></td>
						<td><?php echo $row->name; ?></td>
						<td><?php echo $row->surname; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->email; ?></td>
						<td><?php echo $row->mobile; ?></td>
						<td><?php echo $row->access; ?></td>
						<td><?php echo ($row->is_active == '1') ? "Active" : "In Active"; ?></td>
						<td>
							<a href="<?php echo site_url('admin/users/show_user/'.$row->user_id.'/'.encode_id($row->user_id)); ?>" class="btn btn-primary btn-minier" title="View">View</a>
							<?php if(action_allowed('users', 'edit')){?>
							<a href="<?php echo site_url('admin/users/edit_users/'.$row->user_id.'/'.encode_id($row->user_id)); ?>" class="btn btn-minier btn-yellow" title="Edit">Edit</a>
							<?php }?>
							<?php if(action_allowed('users', 'delete')){?>
							<a href="#" class="delete btn btn-danger btn-minier" id="<?php echo encode_ajax_id($row->user_id); ?>" title="Delete">Delete</a>
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
<script src="<?php echo base_url();?>assets/js/users_list.js"></script>