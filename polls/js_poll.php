<?php
//JS POll

    echo '<script>
$.fn.umsPoll = function ()
{

  var route=$(this).attr(\'data-poll\').split(":");
  var btncontrol = $(this);

  if(route[0]=="vote"){
    var line = $(\'#poll_\'+route[1]).find(\'.line\');
    var btn = $(\'#poll_\'+route[1]).find(\'.btn[data-poll]\');
    $(line).each(function(){
      width = $(this).attr("data-width");
      $(this).width(width+"%");
    });
    $(btn).each(function() {
      $(this).attr(\'disabled\',\'disabled\');
    });
  }
  var formData = new FormData();
  formData.append("ums", "poll");
  formData.append("asset_id", route[2]);
    $.ajax({
           type: "POST",
           url: "'.URLSYSTEM.'api.php",
           data: formData,
           cache: false,
           contentType: false,
           processData: false,
           success: function()
           {   
               btncontrol.empty().html(\'<i class="fa fa-check"></i> <i class="fa fa-thumbs-up"></i>\');
               btncontrol.attr(\'disabled\',\'disabled\').addClass(\'liked\');
           },
           beforeSend: function() 
           {   
              btncontrol.empty().html(\'<i class="fa fa-cog fa-spin"></i>\');
           },
            error: function()
           {  btncontrol.empty().html(\'<i class="fa fa-times"></i>\');
           }
    });
}
        </script>';
  