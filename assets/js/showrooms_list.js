
	$(document).ready(function () {
        
        // $('#postcode').mask('*** ****');
		//delete
        $('#timings_2').mask('99:99 - 99:99');
        $('#timings_1').mask('99:99 - 99:99');
        $(".delete").click(function() {

          var ajax_id = $(this).attr('id');
          var row = $(this).closest('tr');

          bootbox.confirm('Are you sure want to delete this showrooms?', {'verify':true}, function(r)
          {
            if(r)
            {
                deleteAjax(ajax_id,row);
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
                url: base_url + 'showrooms/ajax_delete_showrooms',
                dataType: 'text',
                data : {
                    showrooms_id : id,
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

	});

		