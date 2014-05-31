<div class="row-fluid">
  <div class="span8">
    <div class="form">
      <form class="form form-horizontal" id="settings_frm" method="post" action="<?php echo $action;?>" enctype='multipart/form-data'>
      <input type="hidden" name="settings_id" value="1">
      <input type="hidden" name="logo_img" value="<?php echo $settings['logo_img'];?>">
        <div class="control-group">
          <label class="control-label" for="title">Title*</label>
          <div class="controls">
            <input type="text" id="title" name="title" placeholder="Enter Website Title" value="<?php echo $settings['title'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="tag">Tag Line</label>
          <div class="controls">
            <input type="text" id="tag" name="tag" placeholder="Enter Website Title" value="<?php echo $settings['tag'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="logo">Logo</label>
          <div class="controls">
            <input type="file" id="logo" name="logo" placeholder="Enter Website Title">
            <span class="img"><img style="background-color:#cccccc;" class="img-polaroid" src="<?php get_logo('small');?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="email">Email*</label>
          <div class="controls">
            <input type="text" id="email" name="email" placeholder="Enter Admin Email" value="<?php echo $settings['email'];?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="keywords">Meta Keywords</label>
          <div class="controls">
            <textarea type="text" id="keywords" rows="5" name="keywords" placeholder="Enter Keywords"><?php echo $settings['meta_keywords'];?></textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="description">Meta Description</label>
          <div class="controls">
            <textarea type="text" id="description" rows="5" name="description" placeholder="Enter Description"><?php echo $settings['meta_description'];?></textarea>
          </div>
        </div>

         <!-- <div class="control-group">
          <div class="controls">
            <label>
              <input class="ace-checkbox-2" type="checkbox" <?php if($settings['edit_post'] == '1'){echo "checked='checked'";}?> name="edit_post" value="1"><span class="lbl"> User can edit post.</span>
            </label>
          </div>
        </div> 
        <div class="control-group">
          <div class="controls">
            <label>
              <input class="ace-checkbox-2" type="checkbox" <?php if($settings['delete_post'] == '1'){echo "checked='checked'";}?> name="delete_post" value="1"><span class="lbl"> User can delete post.</span>
            </label>
          </div>
        </div> 
        <div class="control-group">
          <div class="controls">
            <label>
              <input class="ace-checkbox-2" type="checkbox" <?php if($settings['edit_comment'] == '1'){echo "checked='checked'";}?> name="edit_comment" value="1"><span class="lbl"> User can edit comment</span>
            </label>
          </div>
        </div> 
        <div class="control-group">
          <div class="controls">
            <label>
              <input class="ace-checkbox-2" type="checkbox" <?php if($settings['delete_comment'] == '1'){echo "checked='checked'";}?> name="delete_comment" value="1"><span class="lbl"> User can delete comment</span>
            </label>
          </div>
        </div>
         -->
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-success">Update <i class="icon-ok"></i></button>
            <a href="<?php echo base_url('index.php/admin');?>" class="btn btn-default">Cancel <i class="icon-remove"></i></a>
            
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
  $('#settings_frm').validate({
    rules: {
      title: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      logo: {
        extension: "jpg|png|gif"
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
      title:"Enter Website Title",
      content:"Enter Email Address",
      logo: "Please upload image with given extensions (jpg, gif, png)"
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