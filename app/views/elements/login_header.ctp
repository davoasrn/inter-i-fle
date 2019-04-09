<div class="header">
	<div class="top_container"><?php echo $this->Html->link($this->Html->image('LogoRC_Original.gif',array('escape'=>false, 'height'=>"68")).$this->Html->image('logo.jpg',array('escape'=>false)),array(),array('escape'=>false,'class'=>"logo"));?></div>
	<?php if(@$_SESSION['userid']){ ?>
	<a class="addd" href="<?php echo $this->webroot ?>fronts/logout"><button>Logout</button></a>
	<?php } ?>

</div>
