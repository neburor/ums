<?php
#Contact
$form=array(
      'id'    =>'form_glossary',
      'type'  =>'glossary',
      'groupclass'=>'col-xs-12 col-sm-6',
      'callback'=>'/ums/tab/form_glossary'
        );
echo '<div ums class="ums glossary col-xs-12 nopadding" id="agregar">
        <div class="panel panel-default" id="'.$form['id'].'">
          <div class="panel-heading">AGREGAR TÉRMINO</div>
          <div class="panel-body">';


include 'form_glossary_simple.php';

echo '    </div>
        </div>
      </div>';
