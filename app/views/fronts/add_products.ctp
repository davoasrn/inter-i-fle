 
<!--<div class="back">
<?php echo $html->products('Back',array('action'=>'ManageProducts'));	?>
</div>  -->
<h2>Add New Product<h2><p style="font-size: 12px; font-style:normal;">add Product to this site.</p>
<table class="newtable">
<?php echo $this->Form->create('Product',array('url'=>'addProducts','enctype'=>'multipart/form-data')); ?>

<tr>
	<td >Product Name</td>
	<td ><?php echo $this->Form->input('name',array('label'=>false)); ?></td>
</tr>
<tr>
	<td >Company Name</td>
	<td ><?php echo $this->Form->input('companyname',array('label'=>false)); ?></td>
</tr>

<tr>
	<td>Product Category</td>
	
<td><?php  echo $form->input('mainCat',array('type'=>'select','options'=>$mainCategories,'multiple'=>'multiple','label'=>false,'style'=>'margin-left: 10px;','style'=>'margin-left: 10px;')); ?></td>
</tr>


<tr>
	<td>Product Description</td>
	<td><?php echo $this->Form->textarea('productdescription',array('label'=>false)); ?></td>
</tr>

<tr>
	<td>Products Image</td>
	<td><?php echo $this->Form->input('file',array('label'=>false,'type'=>'file')); ?></td>
</tr>


<tr>
	<td>Price </td>
	<td><?php echo $this->Form->input('Price',array('label'=>false)); ?></td>
</tr>

<tr>
	<td><?php echo $this->Form->end('Save'); ?></td>
</tr>
</table>

