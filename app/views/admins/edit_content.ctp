<div class="back">
<?php echo $html->link('Back' ,array('action'=>'ManageContent'));	?>
</div>  

<h2>Edit Content<h2>

<table class="newtable">
	<?php echo $this->Form->create('Content',array('url'=>'editContent/'.$id)); ?>

<tr>
	<td >Name</td>
	<td><?php echo $this->Form->input('name',array('label'=>false)); ?></td>
</tr>
<tr>
	<td>Content</td>
	<td><?php echo $this->Form->textarea('content', array('class'=>'ckeditor')); ?></td>
</tr>

<tr>
	<td><?php echo $this->Form->end('Save'); ?></td>
</tr>

</table>
