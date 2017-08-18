<?php
//JS Wiki
if($_GET['wiki']=='add')
{
  $ckeditorID = 'article_add';
  $ckeditorP = 'add';
}
else
{
  $ckeditorID =  'article_edit';
  $ckeditorP =  'content';
}
if(isset($_GET['wiki']) && $_GET['wiki']!='history' && $_GET['wiki']!='preview' && isset($_SESSION['logged'])) 
{
  if($_GET['wiki']=='advanced')
  {
    echo '<script src="https://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>';
    echo '<script>

            CKEDITOR.replace("'.$ckeditorID.'", {
      on: {
      	instanceReady: function(evt)
      			{
      				evt.editor.commands.save.disable();
      			},
        save: function(evt)
        {
          var data = $("#'.$ckeditorID.'").text().split("\n").join("");
          var oldvalue = $("input[name=old]").val();
          //console.log(oldvalue);
          if(evt.editor.getSnapshot()!=data)
          {
            //console.log(data);
            //console.log(evt.editor.getSnapshot());
            $.ajax({
              	type: "POST",
              	url: "'.$wiki['api'].'",
              	cache: false,
              	data: { old : oldvalue, '.$ckeditorP.': evt.editor.getSnapshot() },
              	xhr: function() {
        			var xhr = new window.XMLHttpRequest();
        			xhr.upload.addEventListener("progress", function(send) {
          				if (evt.lengthComputable) {
            				var percentComplete = send.loaded / send.total;
            				$("#progress-'.$ckeditorID.'").html(Math.round(percentComplete * 100) + "%");
            				$("#progress-'.$ckeditorID.'").width(Math.round(percentComplete * 100)+ "%");
          				}
        	  		}, false);
        			return xhr;
      			}
            }).done(function() {
  				evt.editor.commands.save.disable();
			}).fail(function( jqXHR, textStatus ) {
				if(jqXHR.status==0)
				{
					alert ("Request failed: ERR_INTERNET_DISCONNECTED");
				}
				else
				{
					alert( "Request failed: [" + jqXHR.status +"]" + textStatus );
				}
  				
			});
          }
          else
          {
          }
          return false;
        },
        change: function(evt)
        {
        	evt.editor.commands.save.enable();
        }
    },
    allowedContent : true,
    entities_latin : false,
    htmlEncodeOutput : false,
    entities : false,
    startupOutlineBlocks : true,
    filebrowserImageUploadUrl: "../ums/wiki/ckeditor_imgupload.php"
    });

        </script>';
  }
  else
  {
    echo '<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>';
    echo '<script>
    CKEDITOR.plugins.addExternal( "save", "/ckeditor/save/", "plugin.js" );
    CKEDITOR.plugins.addExternal( "showblocks", "/ckeditor/showblocks/", "plugin.js" );

            CKEDITOR.replace("'.$ckeditorID.'", {
            extraPlugins: "save,showblocks",
      		toolbarGroups: [
        		{"name":"document","item":["save"]},
        		{"name":"colors","item":["TextColor"]},
        		{"name":"basicstyles","groups":["basicstyles"]},
        		{"name":"paragraph","groups": ["list", "blocks", "align" ] },
        		{"name":"links","groups":["links"]},
        		{"name":"insert","item":["image"]},
        		{"name":"styles","groups":["styles"]},
        		{"name":"tools","item":["showblocks"]}
      		],
      		removeButtons: "Underline,Strike,Superscript,Anchor,SpecialChar,Maximize,Subscript,Table,Styles",
      		on: {
      			instanceReady: function(evt)
      			{
      				evt.editor.commands.save.disable();
      			},
        		save: function(evt)
        		{
          			var data = $("#'.$ckeditorID.'").text().split("\n").join("");
          			var oldvalue = $("input[name=old]").val();
          			//console.log(oldvalue);
          			if(evt.editor.getSnapshot()!=data)
          			{
            			//console.log(data);
            			//console.log(evt.editor.getSnapshot());
            			$.ajax({
              				type: "POST",
              				url: "../ums/wiki/api.php",
              				cache: false,
              				data: { old : oldvalue, '.$ckeditorP.': evt.editor.getSnapshot() }
            				}).done(function() {
  								evt.editor.commands.save.disable();
							}).fail(function( jqXHR, textStatus ) {
								if(jqXHR.status==0)
								{
									alert ("Request failed: ERR_INTERNET_DISCONNECTED");
								}
								else
								{
									alert( "Request failed: [" + jqXHR.status +"]" + textStatus );
								}
  				
							});
          			}
          			else
          			{
          			}
          			return false;
        		},
        		change: function(evt)
        		{
        			evt.editor.commands.save.enable();
        		}
    		},
    		allowedContent : true,
    		entities_latin : false,
    		htmlEncodeOutput : false,
    		entities : false,
    		startupOutlineBlocks : true,
    		filebrowserImageUploadUrl: "../ums/wiki/ckeditor_imgupload.php"
    	});
</script>';
  }
}