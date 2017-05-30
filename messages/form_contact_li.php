<?php
//Form contact LI
echo '
	<form class="form" role="form" action="#'.$form['id'].'" method="POST">
		<input type="hidden" name="formid" value="'.$form['id'].'">
		<input type="hidden" name="formtype" value="'.$form['type'].'">
		<div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
		<div class="form-group '.FeedbackClass($_SESSION['feedback'][$form['id']]['message']).'">
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
if($_SESSION['logged']['alert'])
{
  echo '<div class="alert alert-'.key($_SESSION['logged']['alert']).' alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> '.$_SESSION['logged']['alert'][key($_SESSION['logged']['alert'])].'</div>';
}
unset($_SESSION['feedback'][$form['id']]);