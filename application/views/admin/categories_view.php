  <?php include('header.php');?>
<?php include('nav.php');?>
<?php include('sidebar.php');?>
<?php //print_r($this->admin_session->all_userdata());?>
<div id="main-content" class="clearfix">

  <div id="breadcrumbs">
    <ul class="breadcrumb">
      <li><i class="icon-home"></i> <a href="#">Home</a><span class="divider"><i class="icon-angle-right"></i></span></li>
      <li class="active"><?php echo $heading;?></li>
    </ul><!--.breadcrumb-->

    <div id="nav-search">
      <form class="form-search" method="get" action="<?php echo $action_search;?>">
        <span class="input-icon">
          <input autocomplete="off" name="s" id="nav-search-input" type="text" class="input-small search-query" placeholder="Search Categories" value="<?php echo $s;?>" />
          <i id="nav-search-icon" class="icon-search"></i>
        </span>
      </form>
    </div><!--#nav-search-->
  </div><!--#breadcrumbs-->
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
    <div class="page-header position-relative">
      <h1><?php echo $heading;?>
      </h1>

    </div><!--/page-header-->
    <div class="row-fluid">
      <div class="form">
        <form method="post" id="add_cat" action="<?php echo $action;?>" class="form form-horizontal">
        <input type="hidden" value="<?php echo $category_id;?>" name="id">
          <div class="control-group">
            <label class="control-label" for="name">Category Name</label>
            <div class="controls">
              <input type="text" id="name" name="name" placeholder="Enter Category Name" value="<?php echo $name;?>">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="parent">Parent Category</label>
            <div class="controls">
              <select name="parent" id="parent">
                <option <?php if($parent == '0'){echo "selected='selected'";}?> value="0">None</option>
                <?php foreach ($categories as $cat) { ?>
                  <option <?php if($parent == $cat['id']){echo "selected='selected'";}?> value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?></option>
                  <?php if($cat['sub_categories']){?>
                    <?php foreach ($cat['sub_categories'] as $level1Cat) {?>
                      <option <?php if($parent == $level1Cat['id']){echo "selected='selected'";}?> value="<?php echo $level1Cat['id'];?>">- <?php echo $level1Cat['name'];?></option> 
                    <?php }?>
                <?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <div class='control-group'>
            <label class='control-label' for='slug'>Slug</label>
            <div class='controls'>
              <input type='text' id="slug" name='slug' placeholder="Category Slug" value="<?php echo $slug;?>"/>
            </div>
          </div>
          <?php if($type == 'update'){?>
          <div <?php if($parent != '0'){echo "style='display:none'";}?>  id="colorpicker">
            <div class='control-group'>
              <label class='control-label' for='txtcolorpicker'>Select Color</label>
              <div class='controls'>
                <input id='txtcolorpicker' type='text' name='color' class='input-mini' value="<?php echo $color;?>"/>
              </div>
            </div>
          </div>  
          <?php }else{?>
          <div id="colorpicker">
            <div class='control-group'>
              <label class='control-label' for='txtcolorpicker'>Select Color</label>
              <div class='controls'>
                <input id='txtcolorpicker' type='text' name='color' class='input-mini' value="<?php echo $color;?>"/>
              </div>
            </div>
          </div>
          <?php } ?>
           <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-small btn-success"><i class="icon-plus"></i> <?php echo $label;?></button>
              <a class="btn btn-small btn-default" href="<?php echo base_url('admin/category');?>"><i class="icon-remove"></i> Cancel</a>
            </div>
          </div>
        </form>
      </div>
      <div class="space-6"></div>
      <div class="row-fluid">
        <div class="span10">
        <?php echo $pagination;?>
          <table class="table table-striped table-bordered table-hover" id="table_bug_report">
            <thead>
              <tr>
                <!-- <th class="center">
                  <label><input type="checkbox"><span class="lbl"></span></label>
                </th> -->
                <th>Name</th>
                <th>Color</th>
                <th>Slug</th>
                <th>Stats</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php if(!empty($categories)){?>

              <?php foreach ($categories as $category) { ?>
              <tr>
                <!-- <td class="center"><label><input type="checkbox"><span class="lbl"></span></label></td> -->
                <td><a href="#"><strong><?php echo $category['name'];?><strong></a></td>
                <td><span class="span2" style="background-color:<?php echo $category['color'];?>"></span></td>
                <td><?php echo $category['slug'];?></td>
                <td><!-- <p><strong><a href="<?php echo base_url('admin/post?cat='.$category["id"]);?>">Posts</a>: <span class="badge badge-info"><?php echo $category['posts'];?></span></p> --></td>
                <td>
                  <div class="actions-group">
                    <?php if($category['id'] != 1){?>
                      <a class="btn btn-mini btn-info" href="<?php echo base_url('admin/category/'.$category['id']);?>" data-rel="tooltip" title="Edit"><span title="Edit" class="icon-edit edit"></span></a>
                      <button class="btn btn-mini btn-danger" data-rel="tooltip" title="Delete" onclick="destroy(<?php echo $category['id'];?>,<?php echo $category['parent_id'];?>)"><span title="Delete" class="icon-trash delete"></span></button>
                    <?php } ?>
                  </div>
                </td>
              </tr>
                <?php if($category['sub_categories']){?>
                <?php foreach ($category['sub_categories'] as $level1) {?>
                  <tr>
                    <!-- <td class="center"><label><input type="checkbox"><span class="lbl"></span></label></td> -->
                    <td><a href="#">__ <?php echo $level1['name'];?></a></td>
                    <td></td>
                    <td><?php echo $level1['slug'];?></td>
                    <td><p><strong><a href="<?php echo base_url('admin/post?cat='.$level1["id"]);?>">Posts</a> <span class="badge badge-info"><?php echo $level1['posts'];?></span></p></td>
                    <td>
                      <div class="actions-group">
                        <?php if($level1['id'] != 1){?>
                          <a class="btn btn-mini btn-info" href="<?php echo base_url('admin/category/'.$level1['id']);?>" data-rel="tooltip" title="Edit"><span title="Edit" class="icon-edit edit"></span></a>
                          <button class="btn btn-mini btn-danger" data-rel="tooltip" title="Delete" onclick="destroy(<?php echo $level1['id'];?>,<?php echo $level1['parent_id'];?>)"><span title="Delete" class="icon-trash delete"></span></button>
                        <?php } ?>
                      </div>
                    </td>
                  </tr>
                  <?php if($level1['sub_categories']){?>
                  <?php foreach ($level1['sub_categories'] as $level2) {?>
                    <tr>
                      <!-- <td class="center"><label><input type="checkbox"><span class="lbl"></span></label></td> -->
                      <td><a href="#">__ __ <?php echo $level2['name'];?></a></td>
                      <td></td>
                      <td><?php echo $level2['slug'];?></td>
                      <td><p><strong><a href="<?php echo base_url('admin/post?cat='.$level2["id"]);?>">Posts:</a> <span class="badge badge-info"><?php echo $level2['posts'];?></span></p></td>
                      <td>
                        <div class="actions-group">
                          <?php if($level2['id'] != 1){?>
                            <a class="btn btn-mini btn-info" href="<?php echo base_url('admin/category/'.$level2['id']);?>" data-rel="tooltip" title="Edit"><span title="Edit" class="icon-edit edit"></span></a>
                            <button class="btn btn-mini btn-danger" data-rel="tooltip" title="Delete" onclick="destroy(<?php echo $level2['id'];?>,<?php echo $level2['parent_id'];?>)"><span title="Delete" class="icon-trash delete"></span></button>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php }?>
                  <?php }?> 
                <?php }?>
                <?php }?>  
              <?php }?>
              <?php }else{?>
                <tr>
                  <td colspan="6" ><center>No Record Found</center></td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        <?php echo $pagination;?>
        </div>
        <div class="vspace"></div>
      </div><!--/row-->
      <div class="hr hr32 hr-dotted"></div>
      <!-- PAGE CONTENT ENDS HERE -->
    </div><!--/row-->
  </div><!--/#page-content-->
</div><!-- #main-content -->
<?php include('footer.php');?>
<script type="text/javascript">
$(document).ready(function(){

  $('[data-rel=tooltip]').tooltip();
  // popover stats
  $('#user_stats').popover();
  // date picker
  $('.date-picker').datepicker();

  // color picker
  $('#txtcolorpicker').colorpicker();

  // masked input for phone
  $('.input-mask-phone').mask('(999) 999-9999');

  $('#parent').change(function(){
    val = $(this).val();
    if(val == 0){
      $('#colorpicker').show('slow');
    }else{
      $('#colorpicker').hide('slow');
    }
  });
  // select all checkbox
  $('table th input:checkbox').on('click' , function(){
    var that = this;
    $(this).closest('table').find('tr > td:first-child input:checkbox')
    .each(function(){
      this.checked = that.checked;
      $(this).closest('tr').toggleClass('selected');
    });
  });

  // jquery form validation
  $("#add_cat").submit(function( event ) {
    event.preventDefault();
    type = "<?php echo $type;?>";
    if(type == 'add'){
      url = "<?php echo base_url('index.php/admin/category/checkCat')?>";
    }else{
      url = "<?php echo base_url('index.php/admin/category/update')?>";
    }
    

    var name =    $("#add_cat input[name=name]").val();
    var parent =  $("#add_cat select[name=parent]").val();
    var color =   $("#add_cat input[name=color]").val();
    var id =      $("#add_cat input[name=id]").val();
    var slug =    $("#add_cat input[name=slug]").val();

    if(name == ''){
      alert('Enter Category Name');
    }else{
      $.ajax({
        type: "POST",
        url: url,
        data: {id:id,name:name, parent:parent, color:color, slug:slug},
        success: function(response){
          if(response == 0){
            alert('Category Already exist;')
          }else{
              window.location = "<?php echo base_url('admin/category');?>"
          }
        },
        dataType: 'json'
      });
    }
  });

  function add_colorpicker(){
    html = "<div class='control-group'>";
    html += "<label class='control-label' for='txtcolorpicker'>Select Color</label>";
    html += "<div class='controls'>";
    html += "<input id='txtcolorpicker' type='text' name='color' class='input-mini' />";
    html += "</div>";
    html += "</div>";
    $('#colorpicker').html(html);
  }
  function remove_colorpicker(){
    $('#colorpicker').empty(); 
  }
}); //end document.load
function destroy(id, parent) {
  bootbox.confirm("Are you sure you want to delete this category?", function(result) {
    if(result) {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/admin/category/destroy')?>",
        data: {id:id, parent:parent},
        success: function(response){
          if(response == 1){
              window.location = "<?php echo base_url('admin/category');?>"
            }
          },
        dataType: 'json'
      });
    }
  });
}
function UpdateStatus(id) {
  var val;
  if($('#chk_active'+id).is(":checked")){
    val = 1;
  }else{
    val = 0;
  }
  $.ajax({
    type: "POST",
    url: "<?php echo base_url('index.php/admin/category/is_active')?>",
    data: {id:id, val:val},
    success: function(response){
      if(response == 1){
          // location.reload();
        }
      },
    dataType: 'json'
  });
}

</script>