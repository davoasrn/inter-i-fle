<?php
foreach($images as $key => $value){
	$imagedata = getimagesize(IMAGE_URL.'/image_gallery/'.$value['Gallery']['image']);
	$image->resize($value['Gallery']['image'], 100, 100, true,array('border'=>'0', 'alt'=>'My Image'));
}
?>
<script type="text/javascript">
var countUsers = <?php echo count($images); ?>;
jQuery(document).ready(function($) {
	var i;
	for(i = 1; i <= countUsers; i++){
		$("#viewImageDetails"+i).fancybox();
	}
});
</script>

<script type="text/javascript">
function activateImage(id, status){
	jQuery.ajax({
			type	: 'POST',
			async	: false,
			data	: {'data[Gallery][id]':id, 'data[Gallery][status]':status},
			url		: '<?php echo LIVE_SITE; ?>/galleries/activateImage',
			success:function(data)
			{
				if(data == 1){
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/yes.png">';
				}else{
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/no.png">';
				}
				//jQuery("#cmdiv"+id).hide();
				$("#activateImageStatus"+id).html(src);
				alert('Status updated successfully!');

				//jQuery("#activateUserStatus"+id).html(data);
			}
		});
		return false;
}
</script>


<style>.submit{ display:none; }</style>
<div id="icon-mydetails" class="icon32">
	<?php 
	//pr($images); die;
	?>
	<br></div>
<h2 class="dash">
	Manage gallery 
	
	<?php echo $html->link('Add New Image',array('controller'=>'galleries', 'action' => 'addImage'), array('class' => 'button-new', 'escape' => false));?>
	
	<?php if(count($images) > 0){
		
		 ?>
		 
		 <?php echo $html->link('View Slider',array('controller'=>'galleries', 'action' => 'slider'), array('class' => 'button-new', 'escape' => false));?>
		 
		<?php echo $html->link('Remove Selected',array('controller'=>'galleries'), array('id' => 'removeAll', 'title' => 'Remove', 'class' => 'button-new', 'escape' => false));?>
		
	<!--<a id="removeAll" class="button-new" title="Remove" style="cursor:pointer">Remove Selected</a>-->
</h2>
<?php echo $this->Form->create('Gallery',array(
											'url'=>'removeImages',
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
      echo $paginator->prev('<< Previous',array('id'=>'prev','class'=>'roundButtons')); 
      echo $paginator->numbers(array('separator'=>'-')); 
      echo $paginator->next('Next >>',array('id'=>'next','class'=>'roundButtons'));
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
		<th class="centeralign" width="1%">
			<?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall', 'style' => 'float : none;')); ?>
		</th>
		<th class="centeralign" width="1%">S.No.</th>
		<th class="centeralign" width="10%"><?php echo $this->Paginator->sort('Image', 'image'); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Image Title', 'image_title'); ?></th>
		<th class="centeralign" width="70%"><?php echo $this->Paginator->sort('Image Description', 'image_description'); ?></th>
		<th class="centeralign" width="70%"><?php echo $this->Paginator->sort('Image Status', 'status'); ?></th>		
		
	</tr>
	<?php 
	if(count($images) > 0){ 
		$index = 1; 
		foreach($images as $detail){ 
		
			$Id=$detail['Gallery']['id'];
			
			if($detail['Gallery']['status'] == 1){
				$status = $html->link('<span id="activateImageStatus'.$Id.'">'.$html->image("/images/yes.png").'</span>', array('controller'=>'admins', 'action' => 'activateImage', $Id.'/0'), array('escape' => false, 'onclick' => 'javascript:return activateImage('.$Id.', 0);'));
			}
			else{
				$status = $html->link('<span id="activateImageStatus'.$Id.'">'.$html->image("/images/no.png").'</span>', array('controller'=>'admins', 'action' => 'activateImage', $Id.'/1', ), array('escape' => false, 'onclick' => 'javascript:return activateImage('.$Id.', 1);'));
			}
			
			
	?>
		
			<tr>
				<td class="centeralign" width="1%">
					<?php echo $this->Form->checkbox('check',array('class'=>'case','id'=>$detail['Gallery']['id'], 'style' => 'float:none;'));?>
				</td>
				<td class="centeralign" width="1%"><?php echo $index + $pageNo; ?></td>
				<td class="centeralign" width="10%"><?php echo $html->link($html->image( IMAGE_URL.'/image_gallery/imagecache/'.$detail['Gallery']['image'], array('width' => 100, 'height' => 80)),array('controller'=>'galleries', 'action' => 'viewImageDetails', $Id), array('id' => 'viewImageDetails'.$index, 'escape' => false));
				
				?></td>
				<td class="centeralign" width="13%"><?php echo $html->link($detail['Gallery']['image_title'], array('controller'=>'galleries', 'action' => 'editImage', $Id.'/0'), array('escape' => false, 'title' => 'Edit User')); ?></td>
				
				<td class="centeralign" width="70%">
				 <?php  echo $detail['Gallery']['image_description']; ?>
				</td>
				
				<td class="centeralign" width="70%">
				 <?php  echo $status; ?>
				</td>
				 
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
	echo "<h2 align='center'>No Images Found</h2>";
	}
?>
