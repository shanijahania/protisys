	<div class="row-fluid">
		<div class="">
			<div class="listing_head">
				<div id="nav-search">
					<form class="form-search" method="GET" action="<?php echo current_url();?>">
						<span class="input-icon">
							<input autocomplete="off" name="s" id="" type="text" class="input-small" placeholder="Search ..." value="<?php echo $s;?>" />
							<i id="nav-search-icon" class="icon-search"></i>
							<?php
								if($this->admin_session->userdata['admin']['access'] == 'super_admin')
						        {
						         
							?>
									<select id="u_type" name="u_type">
										<?php
										$salesperson = '';
										$partners = '';
										if(isset($_GET['u_type']))
										{
											if($_GET['u_type'] == 'salesperson')
											{
												$salesperson = 'selected';
											}
											elseif($_GET['u_type'] == 'partners')
											{
												$partners = 'selected';
											}

										}
										?>
										<option value=" ">All</option>
										<option value="salesperson" <?=$salesperson?>>Sale Representative </option>
										<option value="partners" <?=$partners?>>Partners </option>
									</select>
							<?php }?>
							<select id="c_status" name="c_status">
								<?php
								$pending = '';
								$paid = '';
								if(isset($_GET['c_status']))
								{
									if($_GET['c_status'] == 'pending')
									{
										$pending = 'selected';
									}
									elseif($_GET['c_status'] == 'paid')
									{
										$paid = 'selected';
									}

								}
								?>
								<option value=" ">All Status</option>
								<option value="pending" <?=$pending?>>Pending</option>
								<option value="paid" <?=$paid?>>Paid </option>
							</select>

							<div class="input-daterange inline" id="datepicker" >   
								<input type="text" class="input-small" value="<?=@$_GET['start']?>" name="start" placeholder="Start Date" readonly="readonly" />
								<span class="add-on" style="vertical-align: top;height:20px">to</span>
								<input type="text" class="input-small" name="end" value="<?=@$_GET['end']?>"  placeholder="End Date" readonly="readonly" />
							</div>
							<div class="btn-group">
								<button class="btn btn-small btn-primary"> <i class="icon-search"></i> Search </button>
								<a href="?" class="btn btn-small btn-primary"><i class="icon-remove"></i></a>
							</div>
						</span>
					</form>
				</div><!--#nav-search-->
				<div><?php echo $pagination;?></div>
			</div>
			<table class="table table-bordered" id="dt_d">
				<thead>
					<tr>
						<th>No.</th>
						<th>User Name</th>
						<th>Order Amount</th>
						<th>Commission</th>
						<th>Commission Persentage</th>
						<th>Commission Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$num = 0; if(isset($comm_records)) :foreach($comm_records as $row): $num++;
					if($row->comm_status == 1){$class="alert alert-success";}else{$class="alert";}
					?>
					<tr class="<?php echo $class;?>">
						<td><?php echo $num;?></td>
						<td><?php echo $row->name; ?></td>
						<td><?php echo $row->ord_total; ?></td>
						<td><?php echo $row->ord_commission; ?></td>
						<td><?php echo $row->ord_commission_persentage; ?> %</td>
						<?php
							if($this->admin_session->userdata['admin']['access'] == 'super_admin')
					        {
					         
						?>
						<td>
							<form id="<?=$row->c_id?>" action="" method="post" style="margin:0">
								<input type="hidden" name="com_id" value="<?=$row->c_id?>" />
								<select name="comm_status">
									<option value="0" <?php if($row->comm_status == 0){?> selected<?php }?>>Pending</option>
									<option value="1" <?php if($row->comm_status == 1){?> selected<?php }?>>Paid</option>
								</select>
							</form>
						</td>
						<?php }else{?>
						<td><?php echo $row->comm_status == 1 ? "Paid" : "Pending"; ?> </td>
						<?php }?>
						<td>
							<a href="<?php echo site_url('admin/orders/show_order/'.$row->ord_id.'/'.encode_id($row->ord_id)); ?>" class="btn btn-primary btn-minier" title="View">View</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
			<?php endif; ?>
		</tbody>
	</table>
	<script type="text/javascript">
		$(document).ready(function(){

			$('select[name=comm_status]').on('change',function(){
				var id = $(this).parent('form').find('input[name=com_id]').val();
				var value = $(this).val();
				var element = $(this);
				var parent = $(this).parent().parent().parent('tr')
				parent.addClass('alert-success');
				element.prop('disabled', 'disabled');
				$.ajax({
					type: "POST",
					url: '<?=base_url("admin/commission/updateStatus")?>' ,
					data: {com_id: id, comm_status: value},
					success: function( response ) 
					{
						if(response == 1)
						{
							if(value == 1)
							{
								parent.addClass('alert-success');
							}
							else
							{
								parent.removeClass('alert-success');	
							}
						}
						else
						{
							console.log('error');
						}
					},
					error: function (error) 
					{
						console.log('error; ' + eval(error));
					}
				});
				element.prop('disabled', '');
			});

			$('.input-daterange').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true
			});
		});
	</script>
</div>
</div>
