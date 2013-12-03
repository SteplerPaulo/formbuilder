<?php 
App::import('Vendor','print_keys');


$form=new KeysForm();
$form->keys($data);
$form->output();
?>