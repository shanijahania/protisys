	<div class="row-fluid">
		<div class="">
			<div class="listing_head">
				<div id="nav-search">
					<form class="form-search" method="GET" action="<?php echo current_url();?>">
						<span class="input-icon">
							<input autocomplete="off" name="s" id="" type="text" class="input-small" placeholder="Search ..." value="<?php echo $s;?>" />
							<i id="nav-search-icon" class="icon-search"></i>
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
			<table class="table table-striped table-bordered" id="dt_d">
				<thead>
					<tr>
						<th>No.</th>
						<th>Order ID</th>
						<th>User Name</th>
						<th>Order Amount</th>
						<th>Commission</th>
						<th>Commission Persentage</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$num = 0; if(isset($comm_records)) :foreach($comm_records as $row): $num++;
					?>
					<tr>
						<td><?php echo $num;?></td>
						<td><?php echo $row->ord_id; ?></td>
						<td><?php echo $row->name; ?></td>
						<td><?php echo $row->ord_total; ?></td>
						<td><?php echo $row->ord_commission; ?></td>
						<td><?php echo $row->ord_commission_persentage; ?> %</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
			<?php endif; ?>
		</tbody>
	</table>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.input-daterange').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });
		});
	</script>
</div>
</div>
