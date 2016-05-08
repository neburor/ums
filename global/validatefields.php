<?php
#Validate fields
include 'validations.php';

function Validate($field,$value)
{
	global $VALIDATIONS;

	$validations=$VALIDATIONS[$field];

	if($validations['required'])
	{
		if($value!='')
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
		else
		{
			$feedback='nodata';
		}
	}
	else
	{
		$feedback='norequired';
	}
	return $feedback;
}
