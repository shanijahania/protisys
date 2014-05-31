<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span6">
			<p>
				<span class="span2"><strong>Name:</strong></span>
				<span class="span8"><?php echo $users_records->name;?></span>
			</p>
			<p>
				<span class="span2"><strong>Surname:</strong></span>
				<span class="span8"><?php echo $users_records->surname;?></span>
			</p>
			<p>
				<span class="span2"><strong>Username:</strong></span>
				<span class="span8"><?php echo $users_records->username;?></span>
			</p>
			<p>
				<span class="span2"><strong>Email:</strong></span>
				<span class="span8"><?php echo $users_records->email;?></span>
			</p>
			<p>
				<span class="span2"><strong>Mobile:</strong></span>
				<span class="span8"><?php echo $users_records->mobile;?></span>
			</p>
			<p>
				<span class="span2"><strong>Access:</strong></span>
				<span class="span8"><?php echo $users_records->access;?></span>
			</p>
			<p>
				<span class="span2"><strong>Status:</strong></span>
				<span class="span8"><?php echo $users_records->is_active;?></span>
			</p>
			<p>
				<span class="span2"><strong>Create Date:</strong></span>
				<span class="span8"><?php echo date("F j, Y, g:i a", strtotime($users_records->created_at));?></span>
			</p>
			<p>
				<span class="span2"><strong>Last Modified:</strong></span>
				<span class="span8"><?php echo date("F j, Y, g:i a", strtotime($users_records->modified_at));?></span>
			</p>
			<p>
				<span class="span2"><strong>Permissions:</strong></span>
				<div class="span8">
					<table class="table table_permission" id="table_bug_report">
						<thead>
							<tr>
								<th class="span2">Module</th>
								<th class="span1">View</th>
								<th class="span1">Add</th>
								<th class="span1">Edit</th>
								<th class="span1">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($modules as $module) { ?>
							<tr>
								<td><?php echo $module->name;?></td>
								<td><label><input disabled name="module[<?php echo $module->id_module;?>][view]" <?php echo (array_key_exists($module->id_module, $permissions) && $permissions[$module->id_module]['view'] == 1)? 'checked="checked"': '';?> value='1' id='all' type="checkbox" class="ace-checkbox-2"><span class="lbl">&nbsp;</span></label></td>
								<td><label><input disabled name="module[<?php echo $module->id_module;?>][add]" <?php echo (array_key_exists($module->id_module, $permissions) && $permissions[$module->id_module]['add'] == 1)? 'checked="checked"': '';?> value='1' type="checkbox" class="ace-checkbox-2"><span class="lbl">&nbsp;</span></label></td>
								<td><label><input disabled name="module[<?php echo $module->id_module;?>][edit]" <?php echo (array_key_exists($module->id_module, $permissions) && $permissions[$module->id_module]['edit'] == 1)? 'checked="checked"': '';?> value='1' type="checkbox" class="ace-checkbox-2"><span class="lbl">&nbsp;</span></label></td>
								<td><label><input disabled name="module[<?php echo $module->id_module;?>][delete]" <?php echo (array_key_exists($module->id_module, $permissions) && $permissions[$module->id_module]['delete'] == 1)? 'checked="checked"': '';?> value='1' type="checkbox" class="ace-checkbox-2"><span class="lbl">&nbsp;</span></label></td>
							</tr>
							<?php }?>	
						</tbody>
					</table>
				</div>
			</p>
			<p class="span12">
				<a class="btn" href="<?php echo site_url('admin/users'); ?>"><i class="icon-reply icon-2x icon-only"></i> All Users</a>
				<?php if(action_allowed('users', 'edit')){?>
				<a class="btn btn-yellow" href="<?php echo site_url('admin/users/edit_users/'.$users_records->id_users.'/'.encode_id($users_records->id_users)); ?>"><i class="icon-edit icon-2x icon-only"></i> Edit</a>
				<?php } ?>
			</p>
			</div>
		</div>
	</div>
</div>