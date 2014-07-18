<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span6">
			<p>
				<span class="span3"><strong>Name:</strong></span>
				<span class="span8"><?php echo $members_records->name;?></span>
			</p>
			<p>
				<span class="span3"><strong>Surname:</strong></span>
				<span class="span8"><?php echo $members_records->surname;?></span>
			</p>
			<p>
				<span class="span3"><strong>Username:</strong></span>
				<span class="span8"><?php echo $members_records->username;?></span>
			</p>
			<?php if($members_records->partner_meta){?>
			<p>
				<span class="span3"><strong>Bussiness Name:</strong></span>
				<span class="span8"><?php echo $members_records->partner_meta->bussiness_name;?></span>
			</p>
			<p>
				<span class="span3"><strong>Contact Name:</strong></span>
				<span class="span8"><?php echo $members_records->partner_meta->contact_name;?></span>
			</p>
			<?php } ?>
			<p>
				<span class="span3"><strong>Email:</strong></span>
				<span class="span8"><?php echo $members_records->email;?></span>
			</p>
			<p>
				<span class="span3"><strong>Mobile:</strong></span>
				<span class="span8"><?php echo $members_records->mobile;?></span>
			</p>
			<p>
				<span class="span3"><strong>Access:</strong></span>
				<span class="span8"><?php echo $members_records->access;?></span>
			</p>
			<p>
				<span class="span3"><strong>Status:</strong></span>
				<span class="span8"><?php echo $members_records->is_active;?></span>
			</p>
			<p>
				<span class="span3"><strong>Create Date:</strong></span>
				<span class="span8"><?php echo date("F j, Y, g:i a", strtotime($members_records->created_at));?></span>
			</p>
			<p>
				<span class="span3"><strong>Last Modified:</strong></span>
				<span class="span8"><?php echo date("F j, Y, g:i a", strtotime($members_records->modified_at));?></span>
			</p>
			<p class="span12">
				<a class="btn" href="<?php echo site_url('admin/'.$module); ?>"><i class="icon-reply icon-2x icon-only"></i> View All</a>
				<?php if(action_allowed('members', 'edit')){?>
				<a class="btn btn-yellow" href="<?php echo site_url('admin/'.$module.'/edit/'.$members_records->user_id); ?>"><i class="icon-edit icon-2x icon-only"></i> Edit</a>
				<?php } ?>
			</p>
			</div>
		</div>
	</div>
</div>