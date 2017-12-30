<?php
//JS Location

    echo '<script>
$.fn.umsLocation = function ()
{
  var select = $(this);
  var type = $(this).attr("name");
  var target =$(this).attr("data-target");
  var formid =$(this).attr("data-form");
  countrys=["mexico","argentina","colombia"];

    if(type=="country" && (countrys.indexOf(select.val()) > -1))
    {     
      $.ajax({
      type: "POST",
      url: "'.URLSYSTEM.'api.php",
      cache: false,
      data: { location : true, country : select.val(), formid : formid },
      success: function(data){ 
        $(target).append(data).show();
        $(target).find("select.location").on("change", function() {
          $(this).umsLocation();
        });
        $(select).parent(".input-group").find("i.fa.fa-refresh").remove();
      },
      beforeSend: function() { 
        $(select).after(\'<i class="fa fa-refresh fa-spin form-control-feedback"></i>\');  
        $(target).empty();
      }
      });
      
    }else if(type=="country"){
      $(target).empty().hide();
    }
    if(type=="state" && select.val()!="all")
    {
      console.log(select.val());
      $.ajax({
      type: "POST",
      url: "'.URLSYSTEM.'api.php",
      cache: false,
      data: { location : true, state : select.val(), formid : formid },
      success: function(data){
        $.each(jQuery.parseJSON(data), function(key,value) {
          $(target).append($("<option></option>")
          .attr("value", value).text(key));
        });
        $(target).append(data).show();

        $(select).parent(".input-group").find("i.fa.fa-refresh").remove();
      },
      beforeSend: function() { 
        $(target + " option:gt(0)").remove();
        $(select).after(\'<i class="fa fa-refresh fa-spin form-control-feedback"></i>\');  
      }
      });
    }else if(type=="state" && select.val()=="all"){
      $(target).removeAttr("required");
    }

}
        </script>';
  