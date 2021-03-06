	<div class="row-fluid">
		<div class="">
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
				<?php if(action_allowed($this->uri->segment(2), 'add')){?>
				<div class="listing_add">
					<a href="<?php echo site_url('admin/' . $this->uri->segment(2) . '/create'); ?>" class="btn btn-success btn-small pull-right"><i class="icon-plus"></i>Add new</a>	
				</div>
				<?php }?>
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
						<?php if($this->uri->segment(2) != 'clients'):?>
							<th>Commission Persentage</th>
						<?php endif;?>
						<th>Notes</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$num = 0; if(isset($members_records)) :foreach($members_records as $row): $num++;
					?>
					<tr>
						<td><?php echo $num;?></td>
						<td><?php echo $row->name; ?></td>
						<td><?php echo $row->surname; ?></td>
						<td><?php echo $row->username; ?></td>
						<td><?php echo $row->email; ?></td>
						<td><?php echo $row->mobile; ?></td>
						<?php if($this->uri->segment(2) != 'clients'):?>
							<td><?php echo $row->commission_per; ?> %</td>
						<?php endif;?>
						<td><?php echo $row->notes; ?></td>
						<td><?php echo ($row->is_active == '1') ? "Active" : "In Active"; ?></td>
						<td>
						<?php if($this->uri->segment(2) != 'clients' ):?>
							<a href="<?php echo site_url('admin/orders/?uid='.$row->user_id.'&role='.$this->uri->segment(2)); ?>" class="btn btn-primary btn-minier" title="View">Orders</a>
						<?php endif;?>
							<a href="<?php echo site_url('admin/'.$module.'/show/'.$row->user_id); ?>" class="btn btn-primary btn-minier" title="View">View</a>
							<?php if(action_allowed($this->uri->segment(2), 'edit')){?>
							<a href="<?php echo site_url('admin/'. $module .'/edit/'.$row->user_id); ?>" class="btn btn-minier btn-yellow" title="Edit">Edit</a>
							<?php }?>
							<?php if(action_allowed($this->uri->segment(2), 'delete')){?>
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
<script src="<?php echo base_url();?>assets/js/members_list.js"></script>