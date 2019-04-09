<?php 
    echo $form->create('User', array('action' => 'register'));
    
    echo $form->input('first_name');
    echo $form->input('last_name');
    echo $form->input('username');
   // echo $form->input('password');
    echo $form->input('password', array('type' => 'password', 'value' => ''));
    echo $form->submit();
    echo $form->end();
?>
