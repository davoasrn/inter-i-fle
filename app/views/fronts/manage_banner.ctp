<script type="text/javascript">
function activateBanner(id, status){
	jQuery.ajax({
			type	: 'POST',
			async	: false,
			data	: {'data[Admin][id]':id, 'data[Admin][status]':status},
			url		: '<?php echo LIVE_SITE; ?>/admins/activateBanner',
			success:function(data)
			{
				if(data == 1){
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/yes.png">';
				}else{
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/no.png">';
				}
				$("#activateBannerStatus"+id).html(src);
	
			}
		});
		return false;
}
</script>
<style>.submit{ display:none; }</style>
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">
	Manage Banner 
	<a class="button-new" href="<?php echo $this->webroot."admins/addBanner"; ?>" title="Add Position">Add New Banner</a>
	
	<!-- CATEGORY SEARCHING FORM START -->
		<table class="newtable" style="width: 35%;float:right;margin-top:0px;">
			<tr>
			<td><?php echo $this->Form->create('Banner',array('url'=>'manageBanner/',  "enctype" => "multipart/form-data"));
			echo $this->Form->input('banName',array('value'=>'Enter Banner Name','onclick'=>"Javascript: if(this.value=='Enter Banner Name'){this.value=''}", 'onblur'=>"Javascript: if(this.value==''){this.value='Enter Banner Name'}",'label'=>false,'style'=>"width: 230px;")); ?>
			<input type="submit" value="Search" style=" float: right;margin-right: 25px;margin-top: -37px;height:25px;">
			<?php echo $this->Form->end(); ?></td>
			</tr>
		</table>
	<!-- CATEGORY SEARCHING FORM END -->
	
	<?php if(count($Banner) > 0){ ?>
	<a id="removeAll" class="button-new" title="Remove" style="cursor:pointer">Remove Selected</a>
	
</h2>
<?php echo $this->Form->create('Admin',array(
											'url'=>'removeBanner',
											'style'=>'clear:none;',
											'id' => 'priceForm')); 
	echo $this->Form->input('idArr',array('id'=>'idArr','style'=>'display:none;','label'=>false));	?>
<?php echo $this->Form->end('Remove'); 
echo $this->Session->flash(); ?>
<br /><br />
    <?php
    echo '<div class="pagingDetails">'.$this->Paginator->counter(array(
    'format' => 'Page %page% of %pages%, showing %current% records out of
    %count% total, starting on record %start%, ending on %end%'
    )).'</div>';
    ?>
<div id="pagination">
<?php
     /* echo $paginator->prev('<< Previous',array('id'=>'prev','class'=>'roundButtons')); 
      echo $paginator->numbers(array('separator'=>'-')); 
      /*echo $paginator->next('Next >>',array('id'=>'next','class'=>'roundButtons'));*/
?>
</div>
<?php
if(isset($this->params['named']['page']) && $this->params['named']['page'] > 1){
	$pageNo = 10 * $this->params['named']['page'] - 10;
}else{
	$pageNo = 0;
}
?>
<table width="100%" class="myTable">
	<tr>
		<th class="centeralign" width="6%">
			<?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall', 'style' => 'float : none;')); ?>
		</th>
		<th class="centeralign" width="6%">Sr.No.</th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Banner Name', 'banner_name',array('style'=>'color:#666666')); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Banner Link', 'banner_link',array('style'=>'color:#666666')); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Status', 'status'); ?></th>
		<th class="centeralign" width="13%">Banner Thumb</th>
		
		
	</tr>
	<?php  
	if(count($Banner) > 0){ 
		$index = 1; 
		
		foreach($Banner as $detail){		
			$Id=$detail['Banner']['id'];	
			if($detail['Banner']['status'] == 1){
				//$statusu = $html->image('/images/yes.png');
				
				//$statusu = $html->link($html->image("/images/yes.png"), array('controller'=>'admins', 'action' => 'activateUser', $Id.'/0'), array('escape' => false));
				
				$statusu = $html->link('<span id="activateBannerStatus'.$Id.'">'.$html->image("/images/yes.png").'</span>', array('controller'=>'admins', 'action' => 'activateBanner', $Id.'/0'), array('escape' => false, 'onclick' => 'javascript:return activateBanner('.$Id.', 0);'));
				
				//$statusu = $html->link(
							
				//$statusu= "<a href='activateUser/$Id/0'><img src='".$this->webroot."/images/yes.png' border='0' /></a>";
			}
			else{
				//$statusu = $html->link($html->image("/images/no.png"), array('controller'=>'admins', 'action' => 'activateUser', $Id.'/1'), array('escape' => false));
				
				$statusu = $html->link('<span id="activateBannerStatus'.$Id.'">'.$html->image("/images/no.png").'</span>', array('controller'=>'admins', 'action' => 'activateBanner', $Id.'/1', ), array('escape' => false, 'onclick' => 'javascript:return activateBanner('.$Id.', 1);'));
				
				//$statusu="<a href='activateUser/$Id/1'><img src='".$this->webroot."/images/no.png' border='0' /></a>";
			} 			
	?>
		
			<tr>
				<td class="centeralign">
					<?php echo $this->Form->checkbox('check',array('class'=>'case','id'=>$detail['Banner']['id'], 'style' => 'float:none;'));?>
				</td>
				<td class="centeralign" ><?php echo $index + $pageNo; ?></td>
				<td class="centeralign" ><?php  $detail['Banner']['banner_name']; ?>
				
				<?php echo $html->link($detail['Banner']['banner_name'], array('controller'=>'admins', 'action' => 'editBanner', $Id.'/0'), array('escape' => false, 'title' => 'Edit Banner')); ?>
				 
				</td>
				<td class="centeralign" ><?php  echo $detail['Banner']['banner_link']; ?>
				
					<td class="centeralign"><?php echo $statusu; ?></td> 
				<td class="centeralign" >
				<?php if($detail['Banner']['banner_image'] !=''){ ?>
				<img src="<?php echo PROFILE_IMAGE_URL.'upload_bannerImages/'.$detail['Banner']['banner_image']; ?>" width="60" height="60"/>
				<?php }else{ ?>
				<img src="<?php echo PROFILE_IMAGE_URL.'upload_bannerImages/default.jpeg'?>" width="60" height="60"/>
				<?php } ?>
				</td>
				</tr> 
	<?php	
		$index += 1;
		} 
	} 
	?>
</table>

	  		

<div id="pagination">
<?php
       echo $paginator->prev('<< Previous',array('id'=>'prev','class'=>'roundButtons'));  
      echo $paginator->numbers(array('separator'=>'-')); 
      echo $paginator->next('Next >>',array('id'=>'next','class'=>'roundButtons')); 
?>
</div>
<br/>
<?php }else{ echo "</h2>";
	echo "<h2 align='center'>No Banner Found</h2>";
	}
?>
