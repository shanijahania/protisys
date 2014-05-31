<?php //print_r($this->admin_session->all_userdata());?>
<?php include('header.php');?>
<?php include('nav.php');?>
<?php include('sidebar.php');?>

<div id="main-content" class="clearfix">
  
  <!-- <div id="breadcrumbs"></div> -->
<?php
  //lets have the flashdata overright "$message" if it exists
  if($this->session->flashdata('success'))
  {
    $message  = $this->session->flashdata('success');
    $html_success = "<div class='alert alert-success'>";
    $html_success .= "<button data-dismiss='alert' class='close' type='button'><i class='icon-remove'></i></button>";
    $html_success .= "<strong>Success !</strong> ".$message;
    $html_success .= "</div>";
    echo $html_success;
  }
  
  if($this->session->flashdata('error'))
  {
    $error  = $this->session->flashdata('error');
    $html_error = "<div class='alert alert-error'>";
    $html_error .= "<button data-dismiss='alert' class='close' type='button'><i class='icon-remove'></i></button>";
    $html_error .= "<strong>Error !</strong> ".$error;
    $html_error .= "</div>";
    echo $html_error;
  }
  
  if(function_exists('validation_errors') && validation_errors() != '')
  {
    $error  = validation_errors();
  }
  ?>
  <div id="page-content" class="clearfix">
    <?php //$current_uri = $this->router->fetch_class().'/'.$this->router->fetch_method(); ?>
    <div class="page-header position-relative">
      <h1><?php echo $heading;?></h1>
    </div><!--/page-header-->

    

    <div class="row-fluid">
      <?php $this->load->view($main); ?>
      <!-- PAGE CONTENT ENDS HERE -->
    </div><!--/row-->
    
  </div><!--/#page-content-->
  

</div><!-- #main-content -->
<?php include('footer.php');?>
 <script type="text/javascript">
    $(function () {
      $('.tabs').tab();
    });
  </script>