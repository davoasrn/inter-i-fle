<?php

?>
 <div id="login">
 

<h3 style="padding-left:99px; font-weight:bold; color:#21759b; font-style:italic;">Forgot Password</span></h2>

<?php echo $session->flash(); ?>
  

        <?php  
	echo $this->Form->create('Admin',array('url'=>'forgotPassword','autocomplete'=>'off'));	
	echo $this->Form->input('email');
	echo $this->Form->end('Submit');
       	?>  
       

<?php echo $form->end();?>  
</div>


