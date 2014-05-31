
$(document).ready(function () {

    CKEDITOR.replace( 'content',
    {
        skin : 'kama',
        toolbar: [
        [ 'Source', '-', 'Bold', 'Italic', 'Underline', '-','TextColor','BGColor','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList'],      // Defines toolbar group without name.
        '/'
        ],
        height: '200px',
        width: '70%'
    });
    $(".delete").click(function() {

      var ajax_id = $(this).attr('id');
      var row = $(this).closest('tr');

      bootbox.confirm('Are you sure want to delete this locations?', {'verify':true}, function(r)
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
            url: base_url + 'locations/ajax_delete_locations',
            dataType: 'text',
            data : {
                locations_id : id,
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

