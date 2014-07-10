<html>
<head>
  <title>Awesome Paypal Payment</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>  
    <script src="<?=base_url()?>/js/bootstrap.min.js" type="text/javascript"></script>  
    <script src="<?=base_url()?>/js/payment.js" type="text/javascript"></script>

    <link rel="stylesheet" href="<?=base_url()?>/css/bootstrap.min.css">
</head>
<body>
<?php
if(!isset($amount))$amount = 80;

?>


<div class=" content " style="padding-top: 60px;">
  <div class="container ">
    <div class="row content-row">
      <div class="register-form payment-form span6 offset3
      
      ">

      
      
        <?= form_open('payment/checkout', array('class'=>' form-horizontal'))?>
          
          <fieldset>
            <legend><h2>Awesome Paypal Payment</h2></legend>
              <div style="padding-top: 25px; padding-bottom: 25px;">
            	  <div class="alert alert-info ">
            	    We love to work with clients. That is why every client can choose how much he wants to pay.
            	  </div>
            	</div>
          	<div class="control-group <?=(isset($errors['pay']) || form_error('pay'))?'error':''?> register-pay">

          		<label for="pay" class="register-pay-label">I want to pay:</label>

          		<div class="controls">
                <label class="radio">
                  <input type="radio" id="pay30" name="payment-amount" value="30" <?=((!empty($amount)) && $amount == 30)?'checked':''?>> $30
                </label>
                <label class="radio">
                  <input type="radio" id="pay80" name="payment-amount" value="80" <?=(!empty($amount) && $amount != 30 && $amount != 110)?'checked':''?>> $80
                </label>
                <label class="radio">
                  <input type="radio" id="pay110" name="payment-amount" value="110" <?=(!empty($amount) && $amount == 110)?'checked':''?>> $110
                </label>
          	  </div>

            </div>
          </fieldset>
          
        	<div class="form-actions">
            <input type="submit" name="register" value="Pay Now" class="btn btn-primary" id="pay-button"  rel="popover" title="<strong>Info</strong>" data-content='You will be forwarded to the <a class ="paypal-infos-btn" href="#">Paypal.com</a> to proceed to the payment.'/>
          </div>
          
          
<!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="#" class="paypal-infos-btn"><img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Images de solution PayPal"></a></td></tr></table><!-- PayPal Logo -->
        </form>
      </div>
      
    </div>
  </div>
</div>
<div id="paypal-loading" class="modal fade in hide" >
  <div class="modal-body" style="text-align: center; padding-bottom: 30px;">
    <h2>Die Verbindung mit der Zahlungswebseite wird erstellt.</h2>
    
    <img src="<?=base_url('img/progress.gif')?>" alt="loading" style="display: block; margin: 15px auto; margin-top: 28px;"/>
  </div>
</div>
</html>
