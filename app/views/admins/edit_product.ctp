<div class="back">
<?php echo $html->link('Back' ,array('action'=>'Manageproducts'));	?>
</div> 
<h2>Edit Product<h2>
<table class="newtable">
<?php echo $this->Form->create('Product',array('url'=>'editProduct/'.$id)); ?>
<tr>
	<td >Product Name</td>
	<td ><?php echo $this->Form->input('name',array('label'=>false)); ?></td>
</tr>
<tr>
	<td >Company Name</td>
	<td ><?php echo $this->Form->input('companyname',array('label'=>false)); ?></td>
</tr>


<tr>
	<td>Price </td>
	<td><?php echo $this->Form->input('price',array('label'=>false)); ?></td>
</tr>

<tr>
	<td><?php echo $this->Form->end('Save'); ?></td>
</tr>
</table>
