<div class="back">
	<?php echo $html->link('Back' ,array('action'=>'ManageContent'));	?>
</div> 
<h2>Add New Article<h2>
<p style="font-size: 12px; font-style:normal;">add content to this site.</p>
<table class="newtable">
	<?php echo $this->Form->create('Content',array('url'=>'addContent')); ?>
<tr>
	<td style="width:200px;">Article Name</td>
	<td><?php echo $this->Form->input('name',array('label'=>false)); ?></td>
</tr>
<tr>&nbsp;</tr>
<tr>&nbsp;</tr>
<tr>&nbsp;</tr>
<tr>
	<td>Article Content</td>
<td><?php echo $this->Form->textarea('content', array('class'=>'ckeditor'));
		   ?></td>
</tr>
<tr>
	<td><?php echo $this->Form->end('Save'); ?></td>
</tr>
</table>

