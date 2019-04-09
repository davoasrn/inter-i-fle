<?php

?>
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">Edit Image <a class="button-new" href="javascript: history.back();" title="Back to previous page">back</a></h2>
<table class="newtable">
	<?php echo $this->Form->create('Gallery',array('url'=>'editImage/'.$info['id'], "enctype" => "multipart/form-data")); ?>	
	<tr>
		<td>Image Title* : </td>
		<td><?php echo $this->Form->input('image_title',array('label'=>false, 'value' => $info['image_title'])); ?></td>
	</tr>
	
	<tr>
		<td>Image Description* : </td>
		<td><?php echo $this->Form->input('image_description',array('label'=>false,  'value' => $info['image_description'])); ?></td>
	</tr>
	<tr>
		<td>Image* : </td>
		<td><?php echo $form->input('image',array("type" => "file", "label" => false)); ?></td>
	</tr>
	
	<tr>
		<td>Status : </td>
		<td><?php echo $form->input('status',array('type'=>'select', 'width' => 100, 'options'=>$statusArray, 'label' => '',  'value' => $info['status'])); ?></td>
	</tr>
	
	<tr>
		<td><?php echo $this->Form->end('Save'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
