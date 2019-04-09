<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<?php
	echo $this->Html->script('ajaxsbmt.js');
?>
<?php echo $javascript->link('fckeditor/fckeditor'); ?> 
	<title>
		<?php __('Interfile Network'); ?>
	</title>
	<?php
		
		echo $this->Html->meta('icon');
		echo $javascript->link('ckeditor/ckeditor');  //ck editior
		echo $javascript->link('jquery.js');
		echo $javascript->link('fancybox/jquery.fancybox.js?v=2.1.0');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
		echo $this->Html->css('select');
		//echo $this->Html->css('style1');
		echo $this->Html->css('all_devices');
		echo $this->Html->css('fancybox/jquery.fancybox.css?v=2.1.0');
		echo $scripts_for_layout;
	?>
<style>
#loading-image {
    border-radius: 10px 10px 10px 10px;
    color: white;
    height: 35px;
    position: fixed;
    right: 700px;
    text-align: center;
    top: 200px;
    width: 76px;
    z-index: 1;
}
</style>	
<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){
		$('#flashMessage').fadeOut('slow',function(){
			$(this).remove();		
		});	
	},2000);
});
</script>

<!-- check all script -->
<SCRIPT language="javascript">
$(document).ready(function(){
    $("#loading-image").show("fast");
	setTimeout(function(){
		$('#content').fadeTo(150,1,function(){
			$("#loading-image").hide();
		});	
	},200);
	
	$("h3.hndle").click(function(){
		$(this).next(".inside").slideToggle("slow");
	});
	$(".handlediv").click(function(){
		$(this).next().next(".inside").slideToggle("slow");
	});
});

</SCRIPT>
</head>
<body>
		<?php echo $this->element('home_header'); ?>
		<?php echo $this->Session->flash(); ?>
		<div class="Container">
			<?php echo $content_for_layout; ?>
		</div>
		<?php echo $this->element('login_footer'); ?>		
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
