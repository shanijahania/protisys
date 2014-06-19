<div class="row-fluid">
	<div class="">
		<form class="form-horizontal" action="" method="post" >
			<fieldset>

				<?php $error = ''; if(form_error('p_name')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Product Name <span class="f_req">*</span></label>
					<div class="controls">
						<input type="text" name="p_name" id="p_name" value="<?php echo set_value('p_name'); ?>" class="input-xlarge"  >
						<?php echo form_error('p_name', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<?php $error = ''; if(form_error('p_price')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Product Price <span class="f_req">*</span></label>
					<div class="controls">
						<input type="text" name="p_price" id="p_price" value="<?php echo set_value('p_price'); ?>" class="input-xlarge"  >
						<?php echo form_error('p_price', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<?php $error = ''; if(form_error('location')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Location </label>
					<div class="controls">
						<select name="location" id="location" class="input-xlarge chosen">
							<option value="usa" <?php echo set_select('location', 'usa'); ?> >USA</option>
							<option value="ecuador" <?php echo set_select('location', 'ecuador'); ?> >Ecuador</option>
						</select>
						<?php echo form_error('location', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<?php $error = ''; if(form_error('p_stock')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Product Stock <span class="f_req">*</span></label>
					<div class="controls">
						<input type="text" name="p_stock" id="p_stock" value="<?php echo set_value('p_stock'); ?>" class="input-xlarge"  >
						<?php echo form_error('p_stock', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<?php $error = ''; if(form_error('p_desc')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Description <span class="f_req">*</span></label>
					<div class="controls">
						<textarea name="p_desc" id="p_desc" ><?php echo set_value('p_desc'); ?></textarea>
						<?php echo form_error('p_desc', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<?php $error = ''; if(form_error('is_active')){ $error = 'error'; } ?>

				<div class="control-group formSep <?php echo $error; ?>">
					<label for="select01" class="control-label">Status </label>
					<div class="controls">
						<select name="is_active" id="is_active" class="input-xlarge chosen">
							<option value="1" <?php echo set_select('is_active', '1'); ?> >Active</option>
							<option value="0" <?php echo set_select('is_active', '0'); ?> >In Active</option>
						</select>
						<?php echo form_error('is_active', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button class="btn btn-gebo btn-success" type="submit"><i class="icon-save"></i> Save</button>
						<a class="btn" href="<?php echo site_url('admin/products'); ?>"><i class="icon-remove"></i> Cancel</a>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</div>
