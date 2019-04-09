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
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){
		$('#flashMessage').fadeOut('slow',function(){
			$(this).remove();		
		});	
	},2000);
});
</script>
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
		<div class="Container">
			<?php echo $content_for_layout; ?>
		</div>
		
</body>
</html>
