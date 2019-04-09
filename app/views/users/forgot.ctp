<?php
    echo $form->create('User', array('action' => 'forgot'));
    echo $form->input('username', array('label' => ''));
    echo $form->end('Reset Password');
?>