<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<?php
	echo $this->Html->script('ajaxsbmt.js');
?>
<?php echo $javascript->link('fckeditor/fckeditor'); ?> 
	<title>
		<?php __('Interfile-Net'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $javascript->link('ckeditor/ckeditor');  //ck editior
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
  <script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>
  <script type="text/javascript">
	  $(document).ready(function(){
		$(".frst_box").click(function () {
			$(".active").removeClass("active");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<noscript type="text/javascript">
function show_confirm()
{
	var r=confirm("Are you sure ?");
	if (r==true)
	  {
	  return true;
	  }
	else
	  {
	  return false;
	  }
}
</noscript>
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
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
       
 
    });
    
    
});
$(document).ready(function(){
		$("#removeAll").click(function(){
				var selectedIds = new Array();
				var n = $("input:checked").length;
				if(n > 0){
				var r = confirm('Are you sure you want to delete?');
				if(r==true)
					{
						$("input.case:checked").each(function(){
							selectedIds.push($(this).attr("id"));
						});
						$('#idArr').val(selectedIds); //return false;
						$("#priceForm").submit(); 
					}
					else{
							return false;
					}  
				}

		});
});
			
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
<div id="loading-image">
	<img src="<?php echo $this->webroot; ?>/images/ajax-loader.gif" alt="Loading..." />
</div>
	<div id="container">
		<div id="header">
			<h1><a href="<?php echo $this->webroot; ?>fronts">Interfile-Net : Content Management System</a><?php //echo $this->Html->link(__('Dynasty Digital: Content Management System', true), ''); ?></h1>
			<div id="wphead-info">
				<div id="user_info">
				<p>Welcome, 
				<a title="Edit your profile" href="<?php echo $this->webroot ?>admins/myProfile/<?php echo $this->Session->read('userid'); ?>">Me(<?php echo $this->Session->read('Admin'); ?>)</a>
				<span class="turbo-nag hidden" style="display: inline;"> |</span> 
				<a title="Log Out" href="<?php echo $this->webroot ?>fronts/logout">Log Out</a></p>
				</div>
			</div>
		</div>
		<div id="content" class="wp-first-item current menu-top menu-top-first menu-top-last" style="opacity:0.3">
		<?php echo $this->element('front_left'); ?>
			
			<div id="bebody">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
			</div>
		</div>
		<div id="footer">
			<p>
				<span id="footer-thankyou">All rigths reserved to  
					<a target="_blank" href="http://universityportal.com/">universityportal.com</a>.
				</span> | 
				<a href="JavaScript:void(0);">Documentation</a> | 
				<a href="JavaScript:void(0);">Feedback</a>
			</p>			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
