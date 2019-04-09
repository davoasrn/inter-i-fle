<div class="back">
<?php echo $html->link('Back' ,array('action'=>'categories'));	?>
</div> 
<h2>Edit Category<h2>
<table class="newtable">
	<?php echo $this->Form->create('Category',array('url'=>'editcategories/'.$id)); ?>
	<tr>
		<td >Category Name</td>
		<td><?php echo $this->Form->input('name',array('label'=>false, 'value'=>$category['Category']['name'])); ?></td>
	</tr>
	<tr>
		<td >Category Description</td>
		<td><?php echo $this->Form->textarea('description',array('label'=>false, 'value'=>$category['Category']['description'])); ?></td>
	</tr>

	<tr>
		<td><?php echo $this->Form->end('Save'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
