</div><!--/.fluid-container#main-container-->
<!-- ****************************************************************** -->
<!--                        Update Password model                       -->
<!-- ****************************************************************** -->

<div class="modal hide" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Update Password</h3>
  </div>
  <form method="post" action="<?=base_url('admin/members/update_password')?>" id="change_password">
    <div class="modal-body">
    
      <p><input type="password" class="span4" name="password_old" id="password_old" placeholder="Old password"></p>

      <p><input type="password" class="span4" name="password" id="password" placeholder="New password"></p>
      <p><input type="password" class="span4" name="password2" id="password2" placeholder="Confirm Password"></p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-warning" data-dismiss="modal">Cancel</a>
      <a href="#" id="btnModalSubmit" class="btn btn-primary">Update</a>
    </div>
  </form>
</div>

<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only"></i>
</a>


<!-- basic scripts -->


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/additional-methods.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easy-pie-chart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/daterangepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-tab.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/date.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.autocomplete.js"></script>
<!-- ace scripts -->
<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>
<!-- inline scripts related to this page -->
<script src="<?php echo base_url();?>assets/js/apprise-v2.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>

</script>
<script type="text/javascript">
$(document).ready(function(){
    $('[data-rel="colorbox"]').colorbox();
});
$(function() {
    $('.dialogs,.comments').slimScroll({
        height: '300px'
    });
    
    $('#tasks').sortable();
    $('#tasks').disableSelection();
    $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
        if(this.checked) $(this).closest('li').addClass('selected');
        else $(this).closest('li').removeClass('selected');
    });

    var oldie = $.browser.msie && $.browser.version < 9;
    $('.easy-pie-chart.percentage').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
        var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
        var size = parseInt($(this).data('size')) || 50;
        $(this).easyPieChart({
            barColor: barColor,
            trackColor: trackColor,
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: parseInt(size/10),
            animate: oldie ? false : 1000,
            size: size
        });
    })

    $('.sparkline').each(function(){
        var $box = $(this).closest('.infobox');
        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
        $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
    });
            
});

</script>
<script type="text/javascript">
  $( document ).ready(function() {
    $('#change_password').validate({
        rules:{
          password_old:{
            required : true, 
             remote: "<?=base_url('admin/members/check_password')?>"
          },
          password:{
            required : true,
          },
          password2 : {
            equalTo : '#password'
          }
        },
        highlight: function(element) {
          $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
          element
          .text('OK!').addClass('valid')
          .closest('.control-group').removeClass('error').addClass('success');
        },
        messages: { 
          password_old: {
            remote: "Password is miss match" 
          }
      }
    });
  });
</script>
</body>
</html>
