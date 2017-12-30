<?php
#Upload image
include('../class.upload_0.32/class.upload.php'); 

function IMGUpload($image,$name,$dir){
	$handle = new Upload($image);
	if ($handle->uploaded) {
      $handle->file_overwrite 		= true;
      $handle->image_convert 		= 'jpg';
      $handle->file_new_name_body 	= $name;
      $handle->image_resize        	= false;
      $handle->image_ratio      	= true;
      $handle->Process($dir);

      $handle->file_overwrite  		= true;
      $handle->image_convert 		= 'jpg';
      $handle->file_new_name_body 	= $name;
      $handle->file_name_body_add 	= '_thumbnail';
      $handle->image_resize         = true;
      $handle->image_ratio_crop     = true;
      $handle->image_watermark 		= '../theme/'.THEMEDIR.'/watermark.png';
      $handle->image_watermark_position = 'BR';
      $handle->image_y              = 250;
      $handle->image_x              = 300;
      $handle->Process($dir);
      if ($handle->processed) {
      	$handle-> Clean();
      	return true;
      }else{
      	$handle-> Clean();
      	return false;
      }
  }else{
  	return false;
  }
}