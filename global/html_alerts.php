<?php 
#Alerts

	echo alerts($_SESSION['feedback']['top']['alerts']);

    unset($_SESSION['feedback']['top']['alerts']);

function alerts($alert)
{
	foreach ($alert as $key => $value) {
		if($key=='info')
		{
			$htmlalert='<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-info-circle"></i></b> '.$value.'</div>';
		}
		if($key=='warning')
		{
			$htmlalert='<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> Error ! </b> '.$value.'</div>';
		}
		if($key=='success')
		{
			$htmlalert='<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-check-circle"></i> Correcto !</b> '.$value.'</div>';
		}
		if($key=='danger')
		{
			$htmlalert='<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-times-circle"></i> Error !</b> '.$value.'</div>';
		}
	}

	return $htmlalert;
}