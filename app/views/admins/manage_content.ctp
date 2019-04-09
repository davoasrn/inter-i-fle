<?php 
$addr="http://";		
$address= $addr.$_SERVER['SERVER_NAME'].trim($this->webroot);
?>
<style>.submit{ display:none; }</style>
<?php echo $this->Form->create('CheckAll',array(
											'url'=>'removeContent',
											'style'=>'clear:none;',
											'id' => 'priceForm')); 
	echo $this->Form->input('idArr',array('id'=>'idArr','style'=>'display:none;','label'=>false));	?>

<h2>Manage Articles &nbsp; <a class="button-new" href="<?php echo $this->webroot; ?>admins/addContent">Add New Article</a></h2>
<?php echo $this->Form->end('Remove'); 
echo $this->Session->flash(); ?>
<a onclick="" id="removeAll" class="roundButtons" title="Remove" style="cursor:pointer">Remove Selected</a><br /><br />
<table width="100%" class="myTable">
	<tr>
		<th><?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall')); ?></th>
		<th>S.No.</th>
		<th><?php echo $this->Paginator->sort('Name', 'name'); ?></th>
		<!--<th><?php echo $this->Paginator->sort('Procedured Type', 'Procedured Type'); ?></th>-->
	<th>Action</th>
	</tr>
	<?php 
	if(count($contents) > 0){ 
	$index = 1; 
	foreach($contents as $detail){ 
	$Id=$detail['Content']['id'];
	if($detail['Content']['status'] == 0){
		$status = "Inactive";
	}
	else{
		$status = "Active";
	} 
	$addr="http://";

	

/*if ($row["Status"]  == "Y")
				{
			  	echo "<a href='manageUsers?active=yes&id=".$row['Id']"'><img src='images/yes.png' border='0' /></a>";
				}*/
		echo '<tr>
				<td width="10%">'.$this->Form->checkbox('check',array('class'=>'case','id'=>$detail['Content']['id'])).'</td>
				<td width="10%">'.$index.'</td>
				<td width="20%">'.$detail['Content']['name'].'</td>
				<!--<td width="10%"><a href="" class="roundButtons">'.$status.'</a></td>--> 
				<td width="15%"><a class="roundButtons" href="'.$this->webroot.'admins/editContent/'.$detail['Content']['id'].'" title="Edit">Edit</a>  
				</td>
		</tr>';  
		$index += 1;
		} 
	} ?>
</table>

			

<div id="pagination">
<?php
      echo $paginator->prev('<< Previous',array('id'=>'prev','class'=>'roundButtons')); 
      echo $paginator->numbers(array('separator'=>'-')); 
      echo $paginator->next('Next >>',array('id'=>'next','class'=>'roundButtons'));
?>
</div>



