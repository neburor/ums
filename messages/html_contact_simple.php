<?php
#Contact
$form=array(
      'id'    =>'form_contact',
      'type'  =>'contact',
      'callback'=>'/ums/tab/form_contact'
        );
echo '<div ums class="ums messages contactus col-xs-12 nopadding">
        <div class="panel panel-default" id="'.$form['id'].'">
          <div class="panel-heading">Contactanos</div>
          <div class="panel-body">';


include 'form_contact.php';

echo '    </div>
        </div>
      </div>';
