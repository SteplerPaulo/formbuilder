<?php 
App::import('Vendor','print_keys');

$form=new KeysForm();
$form->hdr($data);
$form->keys($data);
$form->output();
?>