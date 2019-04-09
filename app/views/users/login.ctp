<?php
    echo $this->Session->flash('auth');
 echo $this->Form->create('User');
 echo $this->Form->input('username');
 echo $this->Form->input('password');
 echo $this->Form->end('Login');
echo $this->Html->link('Sign Up', '/users/register');
echo $this->Html->link('Forgot Password', '/users/forgot');
?>