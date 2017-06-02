<?php
#Avatars
require '../config.php';
$avatars = array_diff(scandir("../theme/".THEMEDIR."/avatars/"), array('..', '.','administracion.png'));
foreach ($avatars as $key => $value) {
	echo '<label>
					<input type="radio" name="pic" value="'.$value.'" ';
				
			echo '/>
    				<img src="'.URLTHEME.'avatars/'.$value.'"/>
 				</label>';
}