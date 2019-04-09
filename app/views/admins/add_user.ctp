<?php
if(isset($javascript)):
        echo $javascript->link('jquery-1.2.6.min.js');
        echo $javascript->link('jquery.imgareaselect-0.4.2.min.js');
endif;
?> 
<div id="icon-mydetails" class="icon32"><br></div>
<h2 class="dash">Add New User <a class="button-new" href="javascript: history.back();" title="Back to previous page">back</a></h2>
<table class="newtable">
	<?php echo $this->Form->create('User',array('url'=>'addUser/',  "enctype" => "multipart/form-data")); ?>	
	<tr>
		<td>First Name* : </td>
		<td><?php echo $this->Form->input('firstname',array('label'=>false)); ?></td>
	</tr>
	
	<tr>
		<td>Last Name* : </td>
		<td><?php echo $this->Form->input('lastname',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>UserName* : </td>
		<td><?php echo $this->Form->input('username',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>UserType* : </td>
		<td><?php $options = array('Network Admin' => 'N/W Admin', 'Studio Admin' => 'Studio Admin' , 'Client' => 'Client' , 'Professionals' => 'Professionals' , 'Collaborator' => 'Collaborator' ,);echo $this->Form->select('user_type', $options,'Network Admin')?></td>
	</tr>
	<tr>
		<td>Password* : </td>
		<td><?php echo $this->Form->input('password',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>Re Enter Password* : </td>
		<td><?php echo $this->Form->input('repassword',array('label'=>false, 'type' =>'password')); ?></td>
	</tr>
	<tr>
		<td>Email* : </td>
		<td><?php echo $this->Form->input('email',array('label'=>false)); ?></td>
	</tr>
	<tr>
		<td>Phone No* : </td>
		<td><?php echo $this->Form->input('phoneno',array('label'=>false)); ?></td>
	</tr>
	
	<tr>
		<td>Date Of birth(Click in the text box, to add date from calender) : </td>
		
		
		<td>
			<?php echo $this->Form->input('date_of_birth',array("onclick" => "return displayDatePicker(this.name);", "label"=>false)); ?>
	</tr>
	
	<tr>
		<td>Status : </td>
		<td><?php echo $form->input('status',array('type'=>'select', 'width' => 100, 'options'=>$statusArray, 'label' => '')); ?></td>
	</tr>
	
	<tr>
		<td>Image : </td>
		<td><?php echo $form->input('image',array("type" => "file", "label" => false)); ?></td>
	</tr>
	
	
	
	<tr>
		<td><?php echo $this->Form->end('Save'); ?></td>
		<td>&nbsp;</td>
	</tr>
</table>

