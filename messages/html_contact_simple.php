<?php
#Contact

echo '<div ums class="ums messages contactus col-xs-12 nopadding">
        <div class="panel panel-default">
          <div class="panel-heading">Contactanos</div>
          <div class="panel-body">';

$form=array(
      'id'    =>'form_contact',
      'type'  =>'contact'
        );
include 'form_contact.php';

echo '    </div>
        </div>
      </div>';
