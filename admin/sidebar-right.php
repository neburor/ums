<?php
#sidebar-right
echo '<nav class="sidebar sidebar-offcanvas-right">      
		<ul class="nav sidebar-nav">';

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

echo '		<li role="separator" class="divider"></li>
			<li><a href="#"><i class="fa fa-cog"></i> Preferencias</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#" data-hash="/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
		</ul>
	</nav>';