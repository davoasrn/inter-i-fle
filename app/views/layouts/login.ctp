<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Login</title>
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
		echo $this->Html->css('style');
		echo $this->Html->css('style1');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('all_devices');
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
	
	jQuery(document).ready(function(){
		$('div#login').hide();
		$('a.forget').click(function(){ 
			$('div#login').show();
		}); 
	});
</script>
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
	<?php echo $this->element('login_header'); ?>
	<?php echo $this->Session->flash(); ?>
	 <!--<div id="loading-image">
		<img src="<?php //echo $this->webroot; ?>/images/ajax-loader.gif" alt="Loading..." />
	</div>-->
	<div id="content" class="wp-first-item current menu-top menu-top-first menu-top-last" style="opacity:0.3">
	</div>	
	<div class="Container_login"><!--main container start-->
	
	    <?php echo $content_for_layout; ?>
	    
	</div><!--main container start-->
	
	
				<?php echo $this->element('login_footer'); ?>		
	
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
