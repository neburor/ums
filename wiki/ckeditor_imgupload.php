<?php
//CKEditor Img Upload

session_start();
include '../config.php';
include '../mysql_db.php';

	if(!empty($_FILES) && isset($_SESSION['logged'])) 
	{
    	foreach ($_FILES as $field => $file) // Validar los campos de archivos del formulario
    	{
        	if($file['size'] < 2097152)
			{
	  			if(preg_match('#\.(?:jpe?g|png|gif)$#',$file['name']))
	  			{
	  				if ($file && move_uploaded_file($_FILES['upload']['tmp_name'],"../../".IMGWIKIDIR.$_SESSION['logged']['id'].'-'.$file['name']))
	  				{ 
    				echo '<script type="text/javascript">
    window.parent.CKEDITOR.tools.callFunction("'.$_GET['CKEditorFuncNum'].'", "'.str_replace("/","\/", URLINDEX).str_replace("/", "\/", IMGWIKIDIR).$_SESSION['logged']['id'].'-'.$file['name'].'", "");
</script>
            ';
    				}
					else 
					{ 
						echo '<script type="text/javascript">
    window.parent.CKEDITOR.tools.callFunction("'.$_GET['CKEditorFuncNum'].'", "", "No se pudo guardar el archivo, intente de nuevo mas tarde.");
</script>';
					}
	  			}
	  			else
	  			{
	  				echo '<script type="text/javascript">
    window.parent.CKEDITOR.tools.callFunction("'.$_GET['CKEditorFuncNum'].'", "", "La extension del archivo no es valida. (JPG,PNG,GIF)");
</script>';
	  			}
	  		}
	  		else 
	  		{
	  			echo '<script type="text/javascript">
    window.parent.CKEDITOR.tools.callFunction("'.$_GET['CKEditorFuncNum'].'", "", "La imagen debe ser menor a 2Mb.");
</script>';
	  		}
    	}
	}
	else
	{
		echo '<script type="text/javascript">
    window.parent.CKEDITOR.tools.callFunction("'.$_GET['CKEditorFuncNum'].'", "", "El archivo no es valido o no has iniciado sesion.");
</script>';
	}
