<?php
#sidebar-right
echo '<nav class="sidebar sidebar-offcanvas-right">      
		<ul class="nav sidebar-nav">';

foreach ($_SESSION['domains'] as $key => $value) {
	echo '<li><a href="#" data-action="domain" data-content="'.$value.'"><i class="fa fa-globe"></i> '.$value.'</a></li>';
}

echo '		<li role="separator" class="divider"></li>
			<li><a href="#"><i class="fa fa-cog"></i> Preferencias</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#" data-hash="/logout"><i class="fa fa-sign-out"></i> Salir</a></li>
		</ul>
	</nav>';