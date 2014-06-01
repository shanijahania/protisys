<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
   <div class="container-fluid">
    <a class="brand" href="<?php echo base_url('admin');?>"><small> <?php echo $this->config->item('site_name');?></small> </a>
    <ul class="nav ace-nav pull-right">
      <li class="light-blue user-profile">
        <a class="user-menu dropdown-toggle" href="#" data-toggle="dropdown">
          <img src="<?php echo get_avatar($this->admin_session->userdata['admin']['id_users'], 'small');?>" alt="img" class="nav-user-photo" />
          <span id="user_info">
            <small>Welcome </small> <?php echo $this->admin_session->userdata['admin']['name'];?>
          </span>
          <i class="icon-caret-down"></i>
        </a>
        <ul id="user_menu" class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
        <?php if(is_access('super_admin')){?>
          <li><a href="<?php echo base_url('admin/settings');?>"><i class="icon-cog"></i> Settings</a></li>
        <?php }?>  
          <li><a href="<?php echo base_url('admin/profile');?>"><i class="icon-user"></i> Profile</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url('index.php/admin/login/logout');?>"><i class="icon-off"></i> Logout</a></li>
        </ul>
      </li>
      
    </ul><!--/.ace-nav-->

   </div><!--/.container-fluid-->
  </div><!--/.navbar-inner-->
</div><!--/.navbar-->
<div class="container-fluid" id="main-container">
<?php //print_r($this->admin_session->all_userdata());?>