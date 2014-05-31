
$(document).ready(function () {

  var user_type = $('#access').val();
  // masked input
  $('#mobile').mask('(999) 999-9999');

  $(".delete").click(function() {
    var ajax_id = $(this).attr('id');
    var row = $(this).closest('tr');

    bootbox.confirm('Are you sure want to delete this member?', {'verify':true}, function(r)
    {
      if(r)
      {
        $.ajax({
          type: "POST",
          url: base_url + 'members/ajax_delete_members',
          dataType: 'text',
          data : {
          members_id : ajax_id,
          },
          success : function(data) {
            if(data=='1')
            {
              location.reload();
            }
            else if(data=='2')
            {
              bootbox.alert('Error.');
            }
            else
            {
              bootbox.alert('Error.');
            }
          },
          error : function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest + " : " + textStatus + " : " + errorThrown);
          }
        });
      }
      else
      {
        return false;
      }
    });

  });

  function deleteAjax(id,row)
  {
    $.ajax({
      type: "POST",
      url: base_url + 'users/ajax_delete_users',
      dataType: 'text',
      data : {
        users_id : id,
      },
      success : function(data) {
        if(data=='1')
        {
          var oTable = $('#dt_d').dataTable();

          var pos = oTable.fnGetPosition(row.get(0));

          oTable.fnDeleteRow(pos);

          bootbox.alert('The users has been deleted');
        }
        else if(data=='2')
        {
          bootbox.alert('Error.');
        }
        else
        {
          bootbox.alert('Error.');
        }
      },
      error : function(XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest + " : " + textStatus + " : " + errorThrown);
      }
    });
  }


    // ******************* Add user validation ********************
    $('#add_member').validate({
      rules: {
        name: {
          required: true
        },
        username: {
          required: true
        },
        password: {
          required: true,
          minlength: 6
        },
        email: {
          required: true,
          email: true
        },
        logo:{

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
        name:       "Name is required",
        username:   "Username is required" ,
        password:   "Password must be atleast 6 characters",
        email:      "Email is required",
        logo:       "Logo must be in valid image extension.",
        access:     "Select user access"
      }
    });

    // ******************* Edit user validation ********************
    $('#edit_user').validate({
      rules: {
        name: {
          required: true
        },
        username: {
          minlength: 6
        },
       
        
        logo:{
          
        },
        access: {
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
        name:       "Name is required",
        username:   "Username is required" ,
        password:   "Password must be atleast 6 characters",
        email:      "Email is required",
        logo:       "Logo must be in valid image extension.",
        access:     "Select user access"
      }
    });

    // ******************* Edit user validation ********************
    $('#checkout').on('click' , function()
    {
      var that = this;
      if(this.checked)
      {
        $('.member_checkout').show('slow');
      }
      else
      {
        $('.member_checkout').hide('slow'); 
      }
    });

    // ******************* Edit user validation ********************
    $('#allow_vrm').on('click' , function()
    {
      var that = this;
      if(this.checked)
      {
        $('.lookup_limit').show('slow');
      }
      else
      {
        $('.lookup_limit').hide('slow'); 
      }
    });

    // ******************* Populate fields on page load ********************
    if($('#checkout').prop('checked'))
    {
      $('.member_checkout').show('slow');
    }
    else
    {
      $('.member_checkout').hide('slow'); 
    }

    if($('#allow_vrm').prop('checked'))
    {
      $('.lookup_limit').show('slow');
    }
    else
    {
      $('.lookup_limit').hide('slow');
    }


  }); //end document ready
  
  function ajax_load(type)
  {
    action = base_url+'users/load_permissions'
    $.ajax({

        type: "POST",
        url: action,
        data: {type: type},
        async: false,
        success: function(response)
        {
          console.log(typeof response);
        },
        dataType: 'html'
    });
  }

