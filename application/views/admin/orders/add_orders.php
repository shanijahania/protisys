<div class="row-fluid">
	<div class="">
		<form class="form-horizontal" action="<?php echo current_url(); ?>" method="post" >
		<input type="hidden" name="status" value="Pending">
		<input type="hidden" name="is_active" value="1">
			<fieldset>

				<?php $error = ''; if(form_error('product_id')){ $error = 'error'; } ?>
				<div class="control-group formSep <?php echo $error; ?>">
					<label for="product_id" class="control-label">Product *</label>
					<div class="controls">
						<select name="product_id" id="product_id">
							<option value="">Select One</option>
							<?php foreach($allProducts as $key => $value):?>
								<option <?php echo  set_select('product_id', $value->product_id); ?> value="<?=$value->product_id?>"><?=$value->product_name?></option>
							<?php endforeach;?>
						</select>
						<?php echo form_error('product_id', '<span class="help-inline">', '</span>'); ?>
					</div>
				</div>
				<?php $error = ''; if(form_error('qty')){ $error = 'error'; } ?>
					<div class="control-group formSep <?php echo $error; ?>">
						<label for="qty" class="control-label">Quantity <span class="f_req">*</span></label>
						<div class="controls">
							<select name="qty" id="qty"  class="input-small">
								<option value="1" <?php echo  set_select('qty', '1'); ?>>1</option>
								<option value="2" <?php echo  set_select('qty', '2'); ?>>2</option>
								<option value="2" <?php echo  set_select('qty', '3'); ?>>3</option>
								<option value="2" <?php echo  set_select('qty', '4'); ?>>4</option>
							</select>
							<?php echo form_error('qty', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>
				<div class="control-group formSep ">
					<label for="select01" class="control-label">Clients</label>
					<div class="controls">
						<select name="client_id" id="client_id">
							<?php foreach($allClients as $key => $value):?>
								<option value="<?=$value->user_id?>"><?=$value->name?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>

				<div class="other_user">
					<?php $error = ''; if(form_error('first_name')){ $error = 'error'; } ?>
					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">First Name <span class="f_req">*</span></label>
						<div class="controls">
							<input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" class="input-xlarge"  >
							<?php echo form_error('first_name', '<span class="help-inline">', '</span>'); ?>
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
					
					<?php $error = ''; if(form_error('email')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Email <span class="f_req">*</span></label>
						<div class="controls">
							<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="input-xlarge"  >
							<?php echo form_error('email', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>
					
					<?php $error = ''; if(form_error('phone')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Phone <span class="f_req">*</span></label>
						<div class="controls">
							<input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" class="input-xlarge"  >
							<?php echo form_error('phone', '<span class="help-inline">', '</span>'); ?>
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
					
					<?php $error = ''; if(form_error('address')){ $error = 'error'; } ?>

					<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Address <span class="f_req">*</span></label>
						<div class="controls">
							<textarea rows="3" cols="10" id="address" name="address"><?php echo set_value('address'); ?></textarea>
							<?php echo form_error('address', '<span class="help-inline">', '</span>'); ?>
						</div>
					</div>
				</div>
				<div class="control-group formSep <?php echo $error; ?>">
						<label for="select01" class="control-label">Payment Method <span class="f_req">*</span></label>
						<div class="controls">
							<label>
								<input type="radio" name="payment_method" <?=set_radio('payment_method', 'cash')?> value="cash"><span class="lbl"> Cash</span>
							</label>
							<label>
								<input type="radio" name="payment_method" <?=set_radio('payment_method', 'paypal')?> value="paypal"><span class="lbl"> Paypal</span>
							</label>
						</div>
					</div>
				<div class="control-group">
					<div class="controls">
						
						<a class="btn" href="<?php echo site_url('admin/orders'); ?>"><i class="icon-remove"></i> Cancel</a>
						<button class="btn btn-gebo btn-success" type="submit"><i class="icon-save"></i> Proceed</button>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#client_id').on('change',function(){
				var val = this.value;
				if( val == 'others')
				{
					$('.other_user').show();
				}
				else
				{
					$('.other_user').hide();
				}
				return false;
			});
		});
	</script>
</div>
