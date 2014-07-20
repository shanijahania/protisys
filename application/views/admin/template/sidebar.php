<?php 
if($this->uri->segment(2) === FALSE){
	$dashboard_class = 'active';
}else{
	$dashboard_class = '';
}

if($this->uri->segment(2) == 'salesperson'){
	$salesperson_class = 'active';
}else{
	$salesperson_class = '';
}
if($this->uri->segment(2) == 'partners'){
	$partners_class = 'active';
}else{
	$partners_class = '';
}
if($this->uri->segment(2) == 'clients'){
	$clients_class = 'active';
}else{
	$clients_class = '';
}
if($this->uri->segment(2) == 'products'){
	$products_class = 'active';
}else{
	$products_class = '';
}
if($this->uri->segment(2) == 'showrooms'){
	$showrooms_class = 'active';
}else{
	$showrooms_class = '';
}
if($this->uri->segment(2) == 'orders'){
	$orders_class = 'active';
}else{
	$orders_class = '';
}


if($this->uri->segment(2) == 'profile'){
	$profile_class = 'active';
}else{
	$profile_class = '';
}
if($this->uri->segment(2) == 'settings'){
	$settings_class = 'active';
}else{
	$settings_class = '';
}
?> 
<a href="#" id="menu-toggler"><span></span></a><!-- menu toggler -->
<div id="sidebar" class="fixed">

	<div id="sidebar-shortcuts">
		<div id="sidebar-shortcuts-large">
			<a href="<?php echo base_url('admin');?>" class="btn btn-small btn-success"><i class="icon-signal"></i></a>
			<a href="<?php echo base_url('admin/settings');?>" class="btn btn-small btn-danger"><i class="icon-cogs"></i></a>
		</div>
		<div id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>
			<span class="btn btn-info"></span>
			<span class="btn btn-warning"></span>
			<span class="btn btn-danger"></span>
		</div>
	</div><!-- #sidebar-shortcuts -->

	<ul class="nav nav-list">

		<li class="<?php echo $dashboard_class;?>">
			<a href="<?php echo base_url('admin');?>">
				<i class="icon-dashboard"></i>
				<span>Dashboard</span>
			</a>
		</li>

		<!-- ************** Module block ***************** -->
		<?php if(module_permission('salesperson')){?>
		<li class="<?php echo $salesperson_class;?>">
			<a href="<?php echo base_url('admin/salesperson');?>">
				<i class="icon-group"></i>
				<span>Sale Representative</span>
			</a>
		</li>
		<?php }?>
		<?php if(module_permission('partners')){?>
		<li class="<?php echo $partners_class;?>">
			<a href="<?php echo base_url('admin/partners');?>">
				<i class="icon-group"></i>
				<span>Partners</span>
			</a>
		</li>
		<?php }?>

		<?php if(module_permission('clients')){?>
		<li class="<?php echo $clients_class;?>">
			<a href="<?php echo base_url('admin/clients');?>">
				<i class="icon-group"></i>
				<span>Clients</span>
			</a>
		</li>
		<?php }?>

		<?php if(module_permission('products')){?>
		<li class="<?php echo $products_class;?>">
			<a href="<?php echo base_url('admin/products');?>">
				<i class="icon-pencil"></i>
				<span>Products</span>
			</a>
		</li>
		<?php }?>
		
		
		<?php if(module_permission('orders')){?>
		<li class="<?php echo $orders_class;?>">
			<a href="<?php echo base_url('admin/orders');?>">
				<i class="icon-shopping-cart"></i>
				<span>Orders</span>
			</a>
		</li>
		<?php }?>
		<?php if(is_access('super_admin') || is_access('partners') || is_access('salesperson')){?>
		<li class="">
			<a href="<?php echo base_url('admin/commission');?>">
				<i class="icon-cogs"></i>
				<span>Commission</span>
			</a>
		</li>
		<?php }?>
		<!-- ************** Module block ***************** -->
		<li class="<?php echo $profile_class;?>">
			<a href="<?php echo base_url('admin/profile');?>">
				<i class="icon-user"></i>
				<span>Profile</span>

			</a>
		</li>

		<?php if(is_access('super_admin')){?>
		<li class="<?php echo $settings_class;?>">
			<a href="<?php echo base_url('admin/settings');?>">
				<i class="icon-cogs"></i>
				<span>Settings</span>
			</a>
		</li>
		<?php }?>


	</ul><!--/.nav-list-->

	<div id="sidebar-collapse"><i class="icon-double-angle-left"></i></div>


</div><!--/#sidebar-->
