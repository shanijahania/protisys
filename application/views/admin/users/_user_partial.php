<?php if($type == 'member'){?>
<div class="control-group">
	<div class="controls">
		<label>
			<input type="checkbox" class="ace-checkbox-2"><span class="lbl"> Allow external checkout.</span>
		</label>
	</div>
</div>
<div class="control-group">
	<div class="controls">
		<label>
			<input type="checkbox" class="ace-checkbox-2"><span class="lbl"> Allow VRM lookup.</span>
		</label>
	</div>
</div>

<?php }elseif($type == 'admin'){?>
<div class="control-group">
	<div class="controls">
		<label>
			<input type="checkbox" class="ace-checkbox-2"><span class="lbl"> Permissions to admin.</span>
		</label>
	</div>
</div>

<?php }else{?>
<?php }?>
