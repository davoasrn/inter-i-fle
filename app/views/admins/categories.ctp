<style>input[type="submit"]{display:none}</style>
<?php echo $this->Form->create('CheckAll',array(
											'url'=>'deletecategories',
											'style'=>'clear:none;',
											'id' => 'priceForm')); 
	echo $this->Form->input('idArr',array('id'=>'idArr','type'=>'hidden','label'=>false));	?>
<?php echo $this->Session->flash();?>
	<h2>Manage Categories &nbsp; 
	<a class="button-new" href="<?php echo $this->webroot; ?>admins/addcategories">Add New Category</a>
</h2>

<a onclick="" id="removeAll" class="roundButtons" title="Remove" style="cursor:pointer">Remove category</a><br /><br />
<table width="100%" class="myTable">
	<tr>
		<th width="10%" class="centeralign"><?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall', 'style'=> 'float : none;')); ?></th>
		<th class="centeralign">S.No.</th>
		<th class="centeralign"><?php echo $this->Paginator->sort('Name', 'name'); ?></th>
		<th class="centeralign">Description</th>
		<th class="centeralign"><?php echo $this->Paginator->sort('Active/ Inactive', 'status'); ?></th>
	</tr>
	<?php
	$count = 1;	
	foreach($categories as $key => $value){
		$Id = $value['Category']['id'];
		$status = ($value['Category']['status'] == 0) ? "<a href='".$this->webroot."admins/activateCategory/$Id/1'><img src='".$this->webroot."images/no.png' border='0' /></a>" : "<a href='".$this->webroot."admins/activateCategory/$Id/0'><img src='".$this->webroot."images/yes.png' border='0' /></a>";	
	?>
	<tr>
		<td class="centeralign">
		<?php echo $this->Form->checkbox('check',array('class'=>'case','id'=>$value['Category']['id'], 'style'=> 'float:none;')); ?></td>
		<td class="centeralign"><?php echo $count;?></td>
		<td><a href ="<?php echo $this->webroot.'admins/editcategories/'.$value['Category']['id'];?>"><?php echo $value['Category']['name'];?></a></td>
		<td><?php echo $value['Category']['description'];?></td>

		<td class="centeralign"><?php echo $status; ?></td>
	</tr>
	<?php 
		$count++;
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

<?php echo $this->Form->end('Remove'); 
?>
