 <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Update User</h3>
    </div>
    <form class="form-horizontal frm_update" id="update_user" action="<?php echo $action_update;?>" method="post">
      <div class="modal-body">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="id" value="<?php echo $user['id'];?>">
        <input type="hidden" name="pass_hash" value="<?php echo $user['password'];?>">
        <div class="control-group">
          <label for="name" class="control-label">Name</label>
          <div class="controls">
            <input type="text" placeholder="Enter Name" id="name" name="name" value="<?php echo $user['name'];?>">
          </div>
        </div>
        <div class="control-group">
          <label for="surname" class="control-label">Surname</label>
          <div class="controls">
            <input type="text" placeholder="Enter Surname" id="surname" name="surname" value="<?php echo $user['surname'];?>">
          </div>
        </div>
        <div class="control-group">
          <label for="username" class="control-label">Username</label>
          <div class="controls">
            <input type="text" placeholder="Entrer Username" id="username" disabled name="username" value="<?php echo $user['username'];?>">
          </div>
        </div>
        <div class="control-group">
          <label for="email" class="control-label">Email</label>
          <div class="controls">
            <input type="text" placeholder="Enter Valid email" id="email" disabled name="email" value="<?php echo $user['email'];?>">
          </div>
        </div>
        <div class="control-group">
          <label for="password" class="control-label">password</label>
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="Change Password">
          </div>
        </div>
        <div class="control-group">
          <label for="gender" class="control-label">Gender</label>
          <div class="controls">
            <select name="gender" id="gender">
              <option value="">Select Gender</option>
              <option <?php if($user['gender'] == 'male'){echo "selected='selected'";}?> value="male">Male</option>
              <option <?php if($user['gender'] == 'female'){echo "selected='selected'";}?> value="female">Female</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label for="location" class="control-label">Location</label>
          <div class="controls">
            <input type="text" name="location" id="location" value="<?php echo $user['location'];?>">
          </div>
        </div>
        <div class="control-group">
          <label for="dob" class="control-label" for="date_range">Age Group</label>
          <div class="controls">
            <select name="date_range" id="date_range">
              <option value="">Select Age Group</option>
              <?php foreach ($ageGroups as $Agroup) { ?>
                <option value="<?php echo $Agroup->group_key;?>" <?php if($Agroup->group_key == $user['age']){echo "selected='selected'";}?>><?php echo $Agroup->group_value;?></option>  
              <?php }?>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label for="mobile" class="control-label">Mobile</label>
          <div class="controls">
            <input type="text" class="input-mask-phone" placeholder="e.g (751)-7XXXXXXX" id="mobile" name="mobile" value="<?php echo $user['mobile'];?>">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success submit_update" type="submit">Update <i class="icon-ok"></i></button>
        <!-- <button type="button" class="btn btn-primary" onclick="frmreset()" aria-hidden="true">Reset <i class="icon-undo"></i></button> -->
        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close <i class="icon-remove"></i></button>
      </div>
    </form>
    <script type="text/javascript">
    $(function() {
      // masked input for phone
      $('.input-mask-phone').mask('(999) 999-9999');

      $("input[name=location]").autocomplete({
        url: "<?php echo base_url('index.php/admin/user/getLocations');?>",
        matchInside :           true,
        mustMatch :             true,
        preventDefaultReturn :  1,
        useCache :              false,
        filterResults :         true,
        autoFill :              true,
      });
      // jquery form validation
      $('#update_user').validate({
        rules: {
          name: {
            required: true
          },
          email: {
            required: true,
            email: true,
            remote: {
              url: "<?php echo base_url('index.php/admin/user/checkEmail');?>",
              type: "post",
              data: {type: 'email'}
            }
          },
          surname: {
            required: true
          },
          gender: {
            required: true
          },
          username: {
            required: true,
            remote: {
              url: "<?php echo base_url('index.php/admin/user/checkEmail');?>",
              type: "post",
              data: {type: 'user'}
            }
          },
          password: {
            minlength: 6
          },
          location: {
            required: true
          },
          date_range: {
            required: true
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
          email:{ remote: "Already Registered" },
          username:{ remote: "Username Already Taken" }
        },
        submitHandler: function() {
          var action = $( "#update_user" ).attr('action');
          var frmdata = $('#update_user').serialize();
          $("#update_user :submit").attr('disabled', 'disable');
          $("#update_user :submit").text('Please Wait');
          $.ajax({
            type: "POST",
            url: action,
            data: frmdata,
            success: function(response){
              $("#update_user :submit").removeAttr('disabled', 'disable');
              var txtSave = 'Save <i class="icon-ok"></i>';
              $("#update_user :submit").html(txtSave);
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