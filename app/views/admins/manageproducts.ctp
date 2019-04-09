<style>
.submit{ 
	display:none; 
}
</style>

<?php 
	echo $this->Form->create('CheckAll',array(
											'url'=>'removeProducts',
											'style'=>'clear:none;',
											'id' => 'priceForm'));
											
	echo $this->Form->input('idArr',array('id'=>'idArr','style'=>'display:none;','label'=>false));
?>
<h2>Manage Products &nbsp;
<a class="button-new" href="<?php echo $this->webroot; ?>admins/addProducts ">Add New Product</a>
</h2>
<?php echo $this->Form->end('Remove'); 

echo $this->Session->flash(); ?>
<a onclick="" id="removeAll" class="roundButtons" title="Remove" style="cursor:pointer">Remove Selected</a><br /><br />
<table width="100%" class="myTable">
	<tr>
		<!--th><?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall')); ?></th-->
		<th><?php echo $this->Form->checkbox('selectAll',array('id'=>'selectall')); ?></th>
		<th>S.No.</th>
		<th>Product Image</th>
		<th><?php echo $this->Paginator->sort('Product Name', 'name'); ?></th>
		<!--th>Categories</th>
		<th>Anatomies</th-->
		<th><?php echo $this->Paginator->sort('Company Name', 'User.companyname'); ?></th>
		<th>Price</th>
		<th>Action</th>
		
		
		
	</tr>
	<?php 
	if(count($products) > 0){ 
	$index = 1; 
	foreach($products as $detail){ 

		echo '<tr>
				<td style="width:30px;">'.$this->Form->checkbox('check',array('class'=>'case','id'=>$detail['Product']['id'])).'</td>
				<td width="10%">'.$index.'</td>
				<td><img src="'.$this->webroot.'img/productImages/thumbs/'.$detail['Product']['thumbimg'].'" width="50" height="50px;" style="border:solid 1px;" /></td>
				<td width="20%">'.$detail['Product']['name'].'&nbsp;</td>
				<td width="20%">'.$detail['User']['companyname'].'</td>
				<td width="20%">'.$detail['Product']['price'].'&nbsp;</td>
				<td width="15%"><a class="roundButtons" href="'.$this->webroot.'admins/editProduct/'.$detail['Product']['id'].'" title="Edit">Edit</a>  
				</td>
		</tr>';  /*<a href="removeUser/'.$detail['User']['id'].'" title="Remove" class="roundButtons" id="confrmbox" onclick="return show_confirm();" >Remove</a>*/
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



