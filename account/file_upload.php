<?php
#FILE UPLOAD

function File_Upload($Files)
{
	include('global/class.upload.php');

	foreach ($Files as $name => $file) 
	{
		if($name=='pic')
		{
			$img_width=110;
			$img_height=110;
			$dir_dest = ('images/pic/');
			$pre='pic_';
		}
		if($name=='cover')
		{
			$img_width=750;
			$img_height=112;
			$dir_dest = ('images/cover/');
			$pre='cover_';
		}

		$handle = new Upload($file);
        

            if ($handle->uploaded) 
            {
                $handle->file_overwrite = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = 100;
                $handle->file_name_body_pre = $pre;
                $handle->file_new_name_body = $_SESSION['profile']['id'];
                $handle->image_resize            = true;
				$handle->image_ratio			 = true;
                $handle->image_ratio_crop        = true;
        		$handle->image_y          		 = $img_height;
        		$handle->image_x                 = $img_width;      
                $handle->Process($dir_dest);
  
                    // we check if everything went OK
                    if ($handle->processed) 
                    {
                    // everything was fine !
                        $response['alert']=array('success' => 'La imagen se guardo satisfactoriamente. Es necesario seleccionarla y guardar los cambios.');
                    } else {
                            // one error occured
                    	$response['alert']=array('warning' => $handle->error );
                            }

                   

            } else {
                    // if we're here, the upload file failed for some reasons
                    // i.e. the server didn't receive the file
            		$response['alert']=array('danger' => $handle->error );
                    }

	}

	return $response;
}