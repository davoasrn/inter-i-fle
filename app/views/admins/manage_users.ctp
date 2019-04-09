<script type="text/javascript">
var countUsers = <?php echo count($users); ?>;
jQuery(document).ready(function($) {
	var i;
	for(i = 1; i <= countUsers; i++){
		$("#viewDetailsPopp"+i).fancybox();
	}
});
</script>
<script type="text/javascript">
function activateUser(id, status){
	jQuery.ajax({
			type	: 'POST',
			async	: false,
			data	: {'data[Admin][id]':id, 'data[Admin][status]':status},
			url		: '<?php echo LIVE_SITE; ?>/admins/activateUser',
			success:function(data)
			{
				if(data == 1){
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/yes.png">';
				}else{
					src = '<img src="<?php echo LIVE_SITE; ?>/img/images/no.png">';
				}
				//jQuery("#cmdiv"+id).hide();
				$("#activateUserStatus"+id).html(src);
				alert('Status updated successfully!');

				//jQuery("#activateUserStatus"+id).html(data);
			}
		});
		return false;
}
</script>
<style>.submit{ display:none; }</style>
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">
	Manage User 
	<a class="button-new" href="<?php echo $this->webroot."admins/addUser"; ?>" title="Add User">Add New User</a>
	
	<?php if(count($users) > 0){ ?>
	<a id="removeAll" class="button-new" title="Remove" style="cursor:pointer">Remove Selected</a>
</h2>
<?php echo $this->Form->create('Admin',array(
											'url'=>'removeUser',
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
		<th class="centeralign" width="3%">
			<?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall', 'style' => 'float : none;')); ?>
		</th>
		<th class="centeralign" width="6%">S.No.</th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('First Name', 'first_name'); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Last Name', 'last_name'); ?></th>		
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('User Name', 'username'); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Email', 'email'); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Phone No', 'phone'); ?></th>
		<th class="centeralign" width="13%"><?php echo $this->Paginator->sort('Status', 'status'); ?></th>
		<th class="centeralign" width="13%">Details</th>
	</tr>
	<?php  
	if(count($users) > 0){ 
		$index = 1; 
		foreach($users as $detail){ 
		
			$Id=$detail['User']['id'];
			 
			if($detail['User']['status'] == 1){
				//$statusu = $html->image('/images/yes.png');
				
				//$statusu = $html->link($html->image("/images/yes.png"), array('controller'=>'admins', 'action' => 'activateUser', $Id.'/0'), array('escape' => false));
				
				$statusu = $html->link('<span id="activateUserStatus'.$Id.'">'.$html->image("/img/images/yes.png").'</span>', array('controller'=>'admins', 'action' => 'activateUser', $Id.'/0'), array('escape' => false, 'onclick' => 'javascript:return activateUser('.$Id.', 0);'));
				
				//$statusu = $html->link(
							
				//$statusu= "<a href='activateUser/$Id/0'><img src='".$this->webroot."/images/yes.png' border='0' /></a>";
			}
			else{
				//$statusu = $html->link($html->image("/images/no.png"), array('controller'=>'admins', 'action' => 'activateUser', $Id.'/1'), array('escape' => false));
				
				$statusu = $html->link('<span id="activateUserStatus'.$Id.'">'.$html->image("/img/images/no.png").'</span>', array('controller'=>'admins', 'action' => 'activateUser', $Id.'/1', ), array('escape' => false, 'onclick' => 'javascript:return activateUser('.$Id.', 1);'));
				
				//$statusu="<a href='activateUser/$Id/1'><img src='".$this->webroot."/images/no.png' border='0' /></a>";
			} 			
	?>
		
			<tr>
				<td class="centeralign" width="10%">
					<?php echo $this->Form->checkbox('check',array('class'=>'case','id'=>$detail['User']['id'], 'style' => 'float:none;'));?>
				</td>
				<td class="centeralign" ><?php echo $index + $pageNo; ?></td>
				<td class="centeralign" ><?php  $detail['User']['firstname']; ?>
				
				<?php echo $html->link($detail['User']['firstname'], array('controller'=>'admins', 'action' => 'editUser', $Id.'/0'), array('escape' => false, 'title' => 'Edit User')); ?>
				 
				</td>
				<td class="centeralign"><?php echo $detail['User']['lastname']; ?></td>
				
				<td class="centeralign"><?php echo $detail['User']['username']; ?></td>
				<td class="centeralign">
					<a href="mailto:<?php echo $detail['User']['email']?>"><?php echo $detail['User']['email']?></a>
				</td>        
				<td class="centeralign"><?php echo $detail['User']['phoneno']; ?></td>
				<td class="centeralign"><?php echo $statusu; ?></td> 
				<td class="centeralign">
					
					<?php echo $html->link('Details', array('controller'=>'admins', 'action' => 'viewUserDetails', $Id.'/0'), array('id' => 'viewDetailsPopp'.$index, 'escape' => false)); ?></tr> 
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
	echo "<h2 align='center'>No Users Found</h2>";
	}
?>
