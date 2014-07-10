<div class="row-fluid">
  <div class="span10">
    <p>
      <div class="alert alert-success">
        <i class="icon-ok"></i>
        <span>Payment successfull with Transaction ID: <strong><?php echo $payment['transaction_id'];?></strong>, Payer ID: <strong><?php echo $payment['payer_id'];?></strong>.</span>
      </div>
      <div class="span12">
        <div><a class="btn btn-info span4" href="<?php echo base_url();?>"><i class="icon-desktop "></i> Return to Dashboard</a></div>
        <div><a class="btn btn-success span4" href="<?php echo base_url('admin/orders');?>"><i class="icon-shopping-cart"></i> Return to Orders</a></div>
      </div>
    </p>
  </div>
</div>