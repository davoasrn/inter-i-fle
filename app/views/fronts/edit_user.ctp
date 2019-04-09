<?php
//pr($info);
?>
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">Edit User <a class="button-new" href="javascript: history.back();" title="Back to previous page">back</a></h2>
<table class="newtable">
	<?php echo $this->Form->create('User',array('url'=>'editUser/'.$info['id'], "enctype" => "multipart/form-data")); ?>	
	<tr>
		<td>First Name* : </td>
		<td><?php echo $this->Form->input('firstname',array('label'=>false, 'value' => $info['firstname'])); ?></td>
	</tr>
	
	<tr>
		<td>Last Name* : </td>
		<td><?php echo $this->Form->input('lastname',array('label'=>false,  'value' => $info['lastname'])); ?></td>
	</tr>
	<tr>
		<td>UserName* : </td>
		<td><?php echo $this->Form->input('username',array('label'=>false,  'value' => $info['username'])); ?></td>
	</tr>
	<tr>
		<td>UserType :</td>
		<td><?php $options = array('Network Admin' => 'N/W Admin', 'Studio Admin' => 'Studio Admin' , 'Client' => 'Client' , 'Professionals' => 'Professionals' , 'Collaborator' => 'Collaborator' ,);echo $this->Form->select('usertype', $options,$info['usertype'])?></td>
	</tr>
	<tr>
		<td>Password* : </td>
		<td><?php echo $this->Form->input('password',array('label'=>false, 'type' =>'password', 'value' => '')); ?></td>
	</tr>
	<tr>
		<td>Re Enter Password* : </td>
		<td><?php echo $this->Form->input('repassword',array('label'=>false, 'type' =>'password', 'value' => '')); ?></td>
	</tr>
	<tr>
		<td>Email* : </td>
		<td><?php echo $this->Form->input('email',array('label'=>false,  'value' => $info['email'])); ?></td>
	</tr>
	<tr>
		<td>Phone No* : </td>
		<td><?php echo $this->Form->input('phoneno',array('label'=>false,  'value' => $info['phoneno'])); ?></td>
	</tr>
	
	
	<tr>
		<td>Status : </td>
		<td><?php echo $form->input('status',array('type'=>'select', 'width' => 100, 'options'=>$statusArray, 'label' => '',  'value' => $info['status'])); ?></td>
	</tr>
	
	<tr>
		<td>Image : </td>
		<td><?php echo $form->input('image',array("type" => "file", 'label' => false)); ?></td>
	</tr>
	
	<tr>
		<td><?php echo $this->Form->end('Save'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
