<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">Add New User <a class="button-new" href="javascript: history.back();">back</a></h2>
<table class="newtable">
	<?php echo $this->Form->create('Admin',array('url'=>'addUser')); ?>	
	<tr>
		<td>First Name</td>
		<td><?php echo $this->Form->input('firstname',array('label'=>false)); ?></td>
	</tr>
	
	<tr>
		<td>Last Name</td>
		<td><?php echo $this->Form->input('lastname',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>UserName</td>
		<td><?php echo $this->Form->input('username',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><?php echo $this->Form->input('password',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>Re-Password</td>
		<td><?php echo $this->Form->input('repassword',array('label'=>false, 'type' =>'password')); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo $this->Form->input('email',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>Phone No : </td>
		<td><?php echo $this->Form->input('phone',array('label'=>false)); ?></td>
	</tr>
	
	<tr>
		<td>Image : </td>
		<td><?php echo $form->input('image',array("type" => "file")); ?></td>
	</tr>
	
	 
	
	
	<tr>
		<td><?php echo $this->Form->end('Save'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>
