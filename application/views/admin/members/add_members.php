<div class="row-fluid">
	<div class="">
		<form class="form-horizontal" action="" method="post" id="add_member1">
			<fieldset>
				<input type="hidden" value="<?=$this->uri->segment(2)?>" name="access">
				
				<?php
					if( ! empty($salespersons)):
				?>

				<?php $error = ''; if(form_error('parent_id')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Sale Representative <span class="f_req">*</span></label>
						<div class="controls">
							<select name="parent_id" id="parent_id">
								<?php foreach ($salespersons as $key => $value):?>
									<option value="<?=$value->id_users?>"><?=$value->name?></option>
								<?php endforeach;?>
							</select>
							<?php echo form_error('name', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>
				<?php elseif( ! empty($partners)):?>
				<?php $error = ''; if(form_error('parent_id')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Partners <span class="f_req">*</span></label>
						<div class="controls">
							<select name="parent_id" id="parent_id">
								<?php foreach ($partners as $key => $value):?>
									<option value="<?=$value->id_users?>"><?=$value->name?></option>
								<?php endforeach;?>
							</select>
							<?php echo form_error('name', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>	
				<?php else:?>
					<input type="hidden" name="parent_id" value="<?=$this->admin_session->userdata['admin']['id_users']?>">
				<?php endif;?>
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

				<?php $error = ''; if(form_error('address')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Address </label>
					<div class="controls">
						<textarea name="address" id="address" class="input-xlarge"  ><?php echo set_value('address'); ?></textarea>
						<?php echo form_error('address', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<?php $error = ''; if(form_error('postcode')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Postcode </label>
					<div class="controls">
						<input type="text" name="postcode" id="postcode" value="<?php echo set_value('postcode'); ?>" class="input-xlarge"  >
						<?php echo form_error('postcode', '<span class="help-inline">', '</span>'); ?>
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

				<?php $error = ''; if(form_error('is_active')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Status <span class="f_req">*</span></label>
					<div class="controls">
						<select name="is_active" id="is_active" class="input-xlarge chosen">
							<option value="1" <?php echo set_select('is_active', '1'); ?> >Active</option>
							<option value="0" <?php echo set_select('is_active', '0'); ?> >In Avtice</option>
						</select>
						<?php echo form_error('is_active', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button class="btn btn-gebo btn-success" type="submit"><i class="icon-save"></i> Save</button>
						<a class="btn" href="<?php echo site_url('admin/'.$module); ?>"><i class="icon-remove"></i> Cancel</a>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</div>
<script src="<?php echo base_url();?>assets/js/members_list.js"></script>