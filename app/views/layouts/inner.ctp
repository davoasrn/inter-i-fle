<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('University Portal'); ?>
		<?php //echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('labbq');
		echo $scripts_for_layout;
		
		//Ajax Validation		 
		//
		echo $this->Html->script('frnt/jquery-1.6.min.js');
		echo $this->Html->script('frnt/jquery.validationEngine.js');	
		echo $this->Html->script('frnt/jquery.validationEngine-en.js');
		echo $this->Html->css('validationEngine.jquery.css');
		/*echo $this->Html->script('frnt/jquery-1.4.3.min.js');
		echo $this->Html->script('frnt/dropdown.js');
		echo $this->Html->script('frnt/dropped.js');*/
?>
<?php //echo $this->element('link'); ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34411004-1']);
  _gaq.push(['_setDomainName', 'medpassage.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
  //jQuery.noConflict();
    $(document).ready(function(){
		// binds form submission and fields to the validation engine
		 $("#formID").validationEngine();
	});
 
</script> 

  <script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>
  <script type="text/javascript">
	  $(document).ready(function(){
		$(".frst_box").click(function () {
			/*$(".med_market").hide();*/
			$(".active").removeClass("active");
		/*	$(this).addClass("active");*/
			$(".content-box").show();
			var content_show = $(this).attr("title");
			$("#"+content_show).hide();
		});
		 $(".nav ul li a").each(function(){
		 $(this).width($(this).width()+15);
	  });
	  $('.navi li a ,.navi_v2 li a').each(function(){
		 $(this).width($(this).width()+4);
	  });
	  	  $(".foot_lt ul li a").each(function(){
		 $(this).width($(this).width()+10);
	  });
	  });
  </script>

</head>

<body>
	
	<?php echo $this->element('header'); ?>
	<?php echo $content_for_layout; ?>
	
	<?php echo $this->element('footer'); ?>
    <?php //echo $this->element('sql_dump'); ?>

</body>
</html>
