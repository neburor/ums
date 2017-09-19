<?php
#Nabvar
echo '<nav class="navbar navbar-inverse navbar-static-top">    
		<div class="container-fluid">      
			<div class="navbar-header">        
				<button type="button" class="navbar-toggle collapsed pull-left" data-offcanvas="offcanvas-left"><i class="fa fa-bars fa-2x"></i></button>
				<a class="navbar-brand" href="http://ums.hostingmex.com.mx/"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web"></a>
				<button type="button" class="navbar-toggle collapsed domainname pull-right" data-offcanvas="offcanvas-right">';
	if(file_exists('theme/'.str_replace('.', '-', $dataForm['domain']).'/icon.png'))
	{
		echo '<img src="ums/admin/theme/'.str_replace('.', '-', $dataForm['domain']).'/icon.png"> ';
	}
	else
	{
		echo '<i class="fa fa-globe fa-2x"></i>';
	}
		echo '<span class="sr-only">'.$dataForm['domain'].'</span></button>
			</div>      
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" class="dropdown-toggle img-link domainname" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">';
	if(file_exists('theme/'.str_replace('.', '-', $dataForm['domain']).'/icon.png'))
	{
		echo '<img src="ums/admin/theme/'.str_replace('.', '-', $dataForm['domain']).'/icon.png"> ';
	}
	else
	{
		echo '<i class="fa fa-globe"></i> ';
	}
		echo $dataForm['domain'].'<span class="caret"></span></a>
						<ul class="dropdown-menu sidebar-right">';

foreach ($_SESSION['domains'] as $key => $value) {
	echo '<li><a href="#" data-action="domain" data-content="'.$value.'">';
	if(file_exists('theme/'.str_replace('.', '-', $value).'/icon.png'))
	{
		echo '<img src="ums/admin/theme/'.str_replace('.', '-', $value).'/icon.png"> ';
	}
	else
	{
		echo '<i class="fa fa-globe"></i> ';
	}
	echo $value.'</a></li>';
}
echo '						<li role="separator" class="divider"></li>
							<li><a href="#"><i class="fa fa-cog"></i> Preferencias</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#" data-hash="/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>';