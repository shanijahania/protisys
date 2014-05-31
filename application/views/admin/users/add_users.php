

<div class="row-fluid">
	<div class="span10">
		<h3 class="heading">Add Users</h3>
		<div class="row-fluid">
			<div class="span8">
				<form class="form-horizontal" action="<?php echo site_url('admin/users/add_users'); ?>" method="post" id="add_user">
					<fieldset>
					<input type="hidden" value="admin" name="access">
						<?php $error = ''; if(form_error('name')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Name <span class="f_req">*</span></label>
							<div class="controls">
								<input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="input-xlarge"  >
								<?php echo form_error('name', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<?php $error = ''; if(form_error('surname')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Surname </label>
							<div class="controls">
								<input type="text" name="surname" id="surname" value="<?php echo set_value('surname'); ?>" class="input-xlarge"  >
								<?php echo form_error('surname', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<?php $error = ''; if(form_error('username')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Username <span class="f_req">*</span></label>
							<div class="controls">
								<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" class="input-xlarge"  >
								<?php echo form_error('username', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<?php $error = ''; if(form_error('password')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Password <span class="f_req">*</span></label>
							<div class="controls">
								<input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="input-xlarge"  >
								<?php echo form_error('password', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<?php $error = ''; if(form_error('email')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Email <span class="f_req">*</span></label>
							<div class="controls">
								<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="input-xlarge"  >
								<?php echo form_error('email', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<?php $error = ''; if(form_error('mobile')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Mobile </label>
							<div class="controls">
								<input type="text" name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>" class="input-xlarge"  >
								<?php echo form_error('mobile', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<?php $error = ''; if(form_error('logo')){ $error = 'error'; } ?>

						<!-- <div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Logo </label>
							<div class="controls">
								<input type="file" name="logo" id="logo" value="<?php echo set_value('logo'); ?>" class="input-xlarge"  >
								<?php echo form_error('logo', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div> -->

						<!-- ***************** Admin meta fields ***************** -->
						<?php $error = ''; if(form_error('module')){ $error = 'error'; } ?>
						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Permissions </label>
							<div class="controls">
								<table class="table table_permission <?php echo $error; ?>" id="table_bug_report">
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
											<td><label><input name="module[<?php echo $module->id_module;?>][view]" value='1' id='all' type="checkbox" class="ace-checkbox-2"><span class="lbl">&nbsp;</span></label></td>
											<td><label><input name="module[<?php echo $module->id_module;?>][add]" value='1' type="checkbox" class="ace-checkbox-2 permission"><span class="lbl">&nbsp;</span></label></td>
											<td><label><input name="module[<?php echo $module->id_module;?>][edit]" value='1' type="checkbox" class="ace-checkbox-2 permission"><span class="lbl">&nbsp;</span></label></td>
											<td><label><input name="module[<?php echo $module->id_module;?>][delete]" value='1' type="checkbox" class="ace-checkbox-2 permission"><span class="lbl">&nbsp;</span></label></td>
										</tr>
									<?php }?>	
									</tbody>
								</table>
								<?php echo form_error('module', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						
						<!-- <div id="output"></div> -->

						<?php $error = ''; if(form_error('is_active')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Status <span class="f_req">*</span></label>
							<div class="controls">
								<select name="is_active" id="is_active" class="input-xlarge chosen">
									<option value="">Select Status</option>
									<option value="1" <?php echo set_select('is_active', '1'); ?> >Active</option>
									<option value="0" <?php echo set_select('is_active', '0'); ?> >In Avtice</option>
								</select>
								<?php echo form_error('is_active', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button class="btn btn-gebo btn-success" type="submit"><i class="icon-save"></i> Save</button>
								<a class="btn" href="<?php echo site_url('admin/users'); ?>"><i class="icon-remove"></i> Cancel</a>
							</div>
						</div>

					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>assets/js/users_list.js"></script>