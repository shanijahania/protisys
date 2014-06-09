	<div class="row-fluid">
		<div class="">
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
					$num = 0; if(isset($members_records)) :foreach($members_records as $row): $num++;
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
</div>
</div>
