<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3 id="myModalLabel">Update Ad</h3>
</div>
<form class="form-horizontal" id="update_ads" action="<?php echo $action_update;?>" method="post" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" name="type" value="update">
    <input type="hidden" name="id" value="<?php echo $ads['id'];?>">
    <input type="hidden" name="image" value="<?php echo $ads['image'];?>">
    <input type="hidden" name="thumb" value="<?php echo $ads['thumb'];?>">
    <div class="control-group">
      <label class="control-label" for="title">Title</label>
      <div class="controls">
        <input type="text" id="title" name="title" placeholder="Enter Ad Title" value="<?php echo $ads['name'];?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="link">Link</label>
      <div class="controls">
        <input type="text" id="link" name="link" placeholder="Enter Link to ad" value="<?php echo $ads['link'];?>">
      </div>
    </div>
    <div class="control-group">
      <label for="location" class="control-label">Target Locations</label>
      <div class="controls">
        <input type="text" name="location" id="location" <?php if($ads['locations'] == '-1'){echo "disabled='disabled'";}?> placeholder="Enter Comma Separated Locations" value="<?php if($ads['locations'] == '-1'){ echo "All Locations";}else{ echo $ads['locations'];}?>">
        <input class="ace-checkbox-2" id="location_all" name="location_all" type="checkbox" value="-1" <?php if($ads['locations'] == '-1'){echo "checked='checked'";}?>><span class="lbl"> All Locations</span>
      </div>  
    </div>
    <div class="control-group">
      <label for="customers" class="control-label">Customers</label>
      <div class="controls">
        <select name="customer" id="customer">
          <option value="">Select Customer</option>
          <?php foreach ($customers as $customer) { ?>

          <option value="<?php echo $customer->user_id;?>" <?php if($customer->user_id == $ads['customer_id']){echo "selected='selected'";}?>><?php echo $customer->name;?></option>
          <?php }?>
        </select>
      </div>  
    </div>
    <div class="control-group">
      <label for="dob" for="age_group" class="control-label">Age Groups</label>
      <div class="controls row">
        <label class="span2"><input class="ace-checkbox-2 age_group_all" id="age_group_all" data-rel="<?php echo $ads['id'];?>" name="age_group[]" type="checkbox" value="-1" <?php if(in_array('-1', $ads['age'])){ echo "checked='checked'";}?>><span class="lbl">All</span></label>
        <?php $row = 0;?>
        <?php foreach ($ageGroups as $Agroup) { ?>
        <?php $checked = '';?>
        <?php if(in_array($Agroup->group_key, $ads['age']) || in_array('-1', $ads['age'])){ $checked = "checked='checked'";}?>
        <label class="span2"><input class="ace-checkbox-2" id="age_group" name="age_group[]" type="checkbox" value="<?php echo $Agroup->group_key;?>" <?php echo $checked;?> ><span class="lbl"><?php echo $Agroup->group_value;?></span></label>
        <?php $row++; ?>
        <?php }?>  
      </div> 
    </div>
    <div class="control-group">
      <label for="adImg" class="control-label">Image</label>
      <div class="controls">
        <input type="file" name="adImg" id="edit_img"><img height="80" id="edit_thumb" src="<?php echo $ads['thumb_src'];?>">
      </div>  
    </div>
    <div class="control-group">
      <label for="starts" class="control-label">Starts on</label>
      <div class="controls">
        <input type="text" class="date-picker starts" name="starts" id="starts" placeholder="Select Start date" value="<?php echo $ads['started'];?>" data-date-format="dd-mm-yyyy">
      </div>  
    </div>
    <div class="control-group">
      <label for="expires" class="control-label">Expires on</label>
      <div class="controls">
        <input type="text" class="date-picker expires" name="expires" id="expires" placeholder="Select End date" value="<?php echo $ads['expired'];?>" data-date-format="dd-mm-yyyy">
      </div>  
    </div>
    <div class="control-group">
      <label for="desc" class="control-label">Description</label>
      <div class="controls">
        <textarea name="desc" id="desc" placeholder="Enter Ad Description"><?php echo $ads['description'];?></textarea>
      </div>  
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-success" type="submit">Update <i class="icon-ok"></i></button>
    <!-- <button type="button" class="btn btn-primary" onclick="frmreset()" aria-hidden="true">Reset <i class="icon-undo"></i></button> -->
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close <i class="icon-remove"></i></button>
  </div>
</form>
<script type="text/javascript">
$(function() {

  $("#edit_img").change(function(event)
  {
     var input = $(event.currentTarget);
     var file = input[0].files[0];
     var reader = new FileReader();

     reader.onload = function(e)
     {
         src = e.target.result;
         $("#edit_img").next().attr('src', src);
     };
     reader.readAsDataURL(file);
    });
  // date picker
  $('.starts').datepicker();
  $('.expires').datepicker();

  // masked input for phone
  $('.input-mask-phone').mask('(999) 999-9999');

  // select all age groups
  $('.age_group_all').on('click' , function(){
    var that = this;
    var cat = $(this).attr('data-rel');
    $(this).parent().parent().find("input[type='checkbox']").each(function(){
      this.checked = that.checked;
      $(this).closest('tr').toggleClass('selected');
    });
  });
  $('#update_ads input[name="age_group[]"]').click(function(){
    len = $('#update_ads input[name="age_group[]"]:checked').length;
    if(!this.checked){
      
      if(len < 7){
        $('#age_group_all').prop('checked', false);
      }
    }else{
      if(len == 6){
        $('#age_group_all').prop('checked', true);
      }
    }
  });

  $("input[name=location]").autocomplete({
        url: "<?php echo base_url('admin/user/getLocations');?>",
        matchInside :           true,
        mustMatch :             true,
        preventDefaultReturn :  1,
        useCache :              false,
        filterResults :         true,
        autoFill :              true,
      });
  // custom validation method
  $.validator.addMethod(
      "checkdate", 
      function(value, element) {
        frm_id = $(element).closest('form').attr('id');
        start = $('#update_ads').find('input[name="starts"]').val();
        end = $('#update_ads').find('input[name="expires"]').val();
        // end = value;
        var d1 = Date.parse( start );
        var d2 = Date.parse( end );
        // console.log(element);

        if (d2 >= d1) {
          response = true;
        }else{
          response = false;
        }
        return response;
      },
      "Expire date must be greater than or equal to Start Date"
  );
  
  $('#update_ads').validate({
    rules: {
      title: {
        required: true
      },
      customer: {
        required: true
      },
      link: {
        required: true,
        url: true
      },
      starts: {
        required: true,
      },
      expires: {
        required: true,
        checkdate: true
      },
      edit_img: {
        extension: "jpg|png|gif|jpeg"
      },
      desc: {
        required: true,
      }
     
    },
    messages: {
      edit_img: "Please upload an Image wiht given extensions (jpg, png, gif)",
      customer : "Please Select a customer",
      desc : "Please Enter Brief description."
    },
    highlight: function(element) {
      $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
      element
      .text('OK!').addClass('valid')
      .closest('.control-group').removeClass('error').addClass('success');
    },
    submitHandler: function() {
      var actionUpdate = $('#update_ads').attr('action');
      var Updatefrmdata = $('#update_ads').serialize();
      var row = '<?php echo $row;?>';
      var formData = new FormData($('form')[0]);
      console.log(formData);
      $('#update_ads:submit').attr('disabled', 'disable');
      $('#update_ads:submit').text('Please Wait');

      $.ajax({
        type: "POST",
        url: actionUpdate,
        data: formData,
        success: function(response){
          $('#update_ads:submit').removeAttr('disabled', 'disable');
          var txtSave = 'Save <i class="icon-ok"></i>';
          $('#update_ads:submit').html(txtSave);
          // frmreset();
          if(response == 1){
            location.reload();
          }
        },
        dataType: 'json'
      });
    },
  });
});
</script>