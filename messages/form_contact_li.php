<?php
//Form contact LI
echo '
	<form class="form" role="form" action="" method="POST">
		<input type="hidden" name="formid" value="'.$form['id'].'">
		<input type="hidden" name="formtype" value="'.$form['type'].'">
		<div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"> <i class="fa fa-edit"></i></span>
				<input type="text" class="form-control" name="message" placeholder="Su mensaje ..." minlength="8" maxlength="512" required="">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default"> <i class="fa fa-reply"></i></button>
				</span>
			</div>
		</div>
	</form>
';
unset($_SESSION['feedback'][$form['id']]);