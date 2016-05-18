<?php
#Validate fields
include 'validations.php';

function Validate_files ($field,$file)
{
	global $VALIDATIONS;

	$validations=$VALIDATIONS[$field];

	if($validations['required'])
	{
		if($file['size'] < $validations['filesize'])
		{
	  		if(preg_match('#'.$validations['pregmatch'].'#',$file['name']))
	  		{
	  			$feedback='valid';
	  		}
	  		else
	  		{
	  			$feedback='nopregmatch';
	  		}
	  	}
	  	else {
	  		$feedback='nosize';
	  	}
	}
	else
	{
		$feedback='norequired';
	}
	return $feedback;
}
function Validate($field,$value)
{
	global $VALIDATIONS;

	$validations=$VALIDATIONS[$field];

	if($validations['required'] && $value!='')
	{
			if(strlen($value)<$validations['minlength'] || strlen($value)>$validations['maxlength'])
			{
				$feedback='nostrlen';
			}
			else
			{
				if($validations['pregmatch'])
				{
					if(preg_match('#'.$validations['pregmatch'].'#',$value))
					{
	  					$feedback='valid';
	  				}
	  				else 
	  				{
	  					$feedback='nopregmatch';
	  				}
				}
				else
				{
					$feedback='valid';
				}
			}	
	}
	elseif(!$validations['required'])
	{
		$feedback='norequired';
	}
	elseif($value=='')
	{
		$feedback='nodata';
	}
	return $feedback;
}
