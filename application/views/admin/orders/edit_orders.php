

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span8">
				<form class="form-horizontal" action="<?php echo site_url('admin/orders/edit_orders'); ?>" method="post" >
					<fieldset>
						
						<?php $error = ''; if(form_error('first_name')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">First Name <span class="f_req">*</span></label>
							<div class="controls">
								<input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name',$orders_records->first_name); ?>" class="input-xlarge"  >
								<?php echo form_error('first_name', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						<?php $error = ''; if(form_error('surname')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Surname </label>
							<div class="controls">
								<input type="text" name="surname" id="surname" value="<?php echo set_value('surname',$orders_records->surname); ?>" class="input-xlarge"  >
								<?php echo form_error('surname', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						<?php $error = ''; if(form_error('email')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Email <span class="f_req">*</span></label>
							<div class="controls">
								<input type="text" name="email" id="email" value="<?php echo set_value('email',$orders_records->email); ?>" class="input-xlarge"  >
								<?php echo form_error('email', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						<?php $error = ''; if(form_error('phone')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Phone <span class="f_req">*</span></label>
							<div class="controls">
								<input type="text" name="phone" id="phone" value="<?php echo set_value('phone',$orders_records->phone); ?>" class="input-xlarge"  >
								<?php echo form_error('phone', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						<?php $error = ''; if(form_error('postcode')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Postcode </label>
							<div class="controls">
								<input type="text" name="postcode" id="postcode" value="<?php echo set_value('postcode',$orders_records->postcode); ?>" class="input-xlarge"  >
								<?php echo form_error('postcode', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						<?php $error = ''; if(form_error('address')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Address <span class="f_req">*</span></label>
							<div class="controls">
								<textarea rows="3" cols="10" id="address" name="address"><?php echo set_value('address',$orders_records->address); ?></textarea>
								<?php echo form_error('address', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
						
						<?php $error = ''; if(form_error('showroom_id')){ $error = 'error'; } ?>

						<div class="control-group formSep <?php echo $error; ?>">
							<label for="select01" class="control-label">Showroom <span class="f_req">*</span></label>
							<div class="controls">
								<select name="showroom_id" id="showroom_id" class="input-xlarge chosen">
									<option value="">Select Showroom</option>
									<?php if(isset($showroom_records)) : foreach($showroom_records as $row) :
									$selected = FALSE; if($orders_records->showroom_id==$row->showroom_id){ $selected = TRUE; }
									?>
									<option value="<?php echo $row->showroom_id; ?>" <?php echo set_select('showroom_id', $row->showroom_id,$selected); ?>  >
										<?php echo $row->name; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
								</select>
								<?php echo form_error('showroom_id', '<span class="help-inline">', '</span>'); ?>
							</div>
						</div>
					
					<?php $error = ''; if(form_error('vehicle_registration')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Vehicle Registration <span class="f_req">*</span></label>
						<div class="controls">
							<input type="text" name="vehicle_registration" id="vehicle_registration" value="<?php echo set_value('vehicle_registration',$orders_records->vehicle_registration); ?>" class="input-xlarge"  >
							<?php echo form_error('vehicle_registration', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>
					
					<?php $error = ''; if(form_error('is_active')){ $error = 'error'; } ?>

					<?php $error = ''; if(form_error('status')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Status <span class="f_req">*</span></label>
						<div class="controls">
							<select name="status" id="status" class="input-xlarge chosen">
								<option value="">Select Status</option>
								<?php if(isset($order_status)) : foreach($order_status as $row) :
								$selected = FALSE; if($orders_records->status==$row->name){ $selected = TRUE; }
								?>
								<option value="<?php echo $row->name; ?>" <?php echo set_select('status', $row->name,$selected); ?>  >
									<?php echo $row->name; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
							</select>
							<?php echo form_error('status', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>
					
					<div class="control-group">
						<div class="controls">
							<button class="btn btn-gebo btn-success" type="submit"><i class="icon-save"></i> Save Changes</button>
							<a class="btn" href="<?php echo site_url('admin/orders'); ?>"><i class="icon-remove"></i> Cancel</a>
						</div>
					</div>

					<input type="hidden" name="orders_id" value="<?php echo $orders_records->order_id; ?>" />

				</fieldset>
			</form>
		</div>
	</div>
</div>
</div>
<script src="<?php echo base_url();?>assets/js/orders_list.js"></script>