<div class="row-fluid">
  <div class="span8">
    <div class="form">
      <form class="form form-horizontal" id="profile_frm" method="post" action="<?php echo $action;?>" enctype='multipart/form-data'>
      <input type="hidden" name="profile_id" value="<?php echo $this->admin_session->userdata['admin']['id_users'];?>">
      <input type="hidden" name="token" value="<?php echo $profile['password'];?>">
      <input type="hidden" name="avatar" value="<?php echo $profile['avatar'];?>">
        <div class="control-group">
          <label class="control-label" for="name">Name*</label>
          <div class="controls">
            <input type="text" id="name" name="name" placeholder="Enter Your Name" value="<?php echo $profile['name'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="surname">Surname*</label>
          <div class="controls">
            <input type="text" id="surname" name="surname" placeholder="Enter Surname" value="<?php echo $profile['surname'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="username">Username</label>
          <div class="controls">
            <input type="text" disabled="disabled" id="username" name="username" placeholder="Enter Username" value="<?php echo $profile['username'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="password">Password</label>
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="Change Password" value="">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input type="text" disabled="disabled" id="email" name="email" placeholder="Enter Email" value="<?php echo $profile['email'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="mobile">Mobile</label>
          <div class="controls">
            <input type="text" id="mobile" class="input-mask-phone" name="mobile" placeholder="Enter Mobile" value="<?php echo $profile['mobile'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="address">Address*</label>
          <div class="controls">
            <textarea id="address" name="address" placeholder="Enter address"><?php echo $profile['address'];?></textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="avatar">Avatar</label>
          <div class="controls">
            <input type="file" id="avatar" name="avatar">
            <span class="img"><img class="img-polaroid" src="<?php echo get_avatar($profile['id'], 'small');?>">
          </div>
        </div>
        <div class="control-group">
          <label for="dob" class="control-label" for="gender">Gender</label>
          <div class="controls">
            <select name="gender" id="gender">
              <option value="">Select Gender</option>
              <option <?php if($profile['gender'] == 'male'){echo "selected='selected'";}?> value="male">Male</option>
              <option <?php if($profile['gender'] == 'female'){echo "selected='selected'";}?>value="female">Female</option>
            </select>
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-success">Update <i class="icon-ok"></i></button>
            <a href="<?php echo base_url('admin/profile');?>" class="btn btn-default">Cancel <i class="icon-remove"></i></a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="vspace"></div>
</div><!--/row-->

<script type="text/javascript">
$(document).ready(function(){

  // CKEDITOR.replace( 'content',
  // {
  //   skin : 'kama',
  //   toolbar: [
  //   [ 'Source', '-', 'Bold', 'Italic', 'Underline', '-','TextColor','BGColor','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList'],      // Defines toolbar group without name.
  //   '/'
  //   ],
  //   height: '200px',
  //   width: '50%'
  // });

  $('[data-rel=tooltip]').tooltip();
  // popover stats
  $('#user_stats').popover();
  // date picker
  $('.date-picker').datepicker();

  // masked input for phone
  $('.input-mask-phone').mask('(999) 999-9999');


  // select all checkbox
  $('table th input:checkbox').on('click' , function(){
    var that = this;
    $(this).closest('table').find('tr > td:first-child input:checkbox').each(function(){
      this.checked = that.checked;
      $(this).closest('tr').toggleClass('selected');
    });

  });

  // jquery form validation
  $('#profile_frm').validate({
    rules: {
      name: {
        required: true
      },
      surname: {
        required: true,
      },
      location: {
        required: true,
      },
      age: {
        required: true,
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
      title:"Please enter your name",
      surname:"Please enter Surname",
      location:"Please select location",
      age:"Please select age group"
    }
  });

  // check for categories
  $("input[name='cats[]']").click( function (event) {
    event.preventdefault;
    length = $("input[name='cats[]']:checked").length;
    if(length > 3){
      $(this).removeAttr('checked');
      alert("You can not select more then 3 areas")
    }
    // $("input[name='cats[]']").each( function () {

    //   if($(this).is(":checked")){
    //     alert('checked');
    //   }

    // });

  });

  // autocomplete towns
  $("input[name=location]").autocomplete({
    url: "<?php echo base_url('index.php/admin/user/getLocations');?>",
    useCache: false,
    filterResults: true,
    autoFill: true,
  });
}); //end document.load
// reset a form after submission
  function frmreset(){
    $(':input','#page_frm')
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .removeAttr('checked')
    .removeAttr('selected');
  }
</script>