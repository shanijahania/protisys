<?php $this->load->view('layout/header_register');

if(!isset($amount))$amount = 80;

?>


<div class="content" id="" style="padding-top: 18px;">

  <div class="hero-unit" style="">
    <div id="welcome-pic">
      <img src="<?=base_url('img/layout/welcome-pic6.png')?>" alt=""  style="margin-top: -220px; "/>
    </div>
    <h1 class="" style="margin-top: -80px;">So cool hast du dich entschieden!</h1>
    <?php if(!empty($payment)):?>
     <pre><?php print_r($payment);?></pre>
    <?php endif; ?>
  </div>
</div>
        
      

  </div>
</div>

<?php $this->load->view('layout/footer');?>
