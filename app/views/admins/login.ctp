<div id="login">
<?php echo $this->Session->flash(); ?>
		<h2 style="padding-left:40px; font-weight:bold; color:#464646">Administrator <span style="color:#21759b">Login</span></h2>	
	<?php
			echo $this->Form->create('Admin',array('url'=>'login','autocomplete'=>'off', 'class' =>'adminLogin'));		
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->end('Login');
	?>
	
	<p id="nav">
		<a href="forgotPassword" title="Password Lost and Found">Lost your password?</a>
	</p>

	<p id="backtoblog"><a href="<?php echo $this->webroot; ?>" title="Are you lost?">? Back to Front View</a></p>
	</div>
