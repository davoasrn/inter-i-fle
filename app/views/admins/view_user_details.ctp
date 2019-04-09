<?php

?>
<table class="newsTableFancy">
	<tr>
		<td class="detailesUser">First Name : </td>
		<td class="detailesUser"><?php echo $info['firstname']; ?></td>
	</tr>
	
	<tr>
		<td class="detailesUser">Last Name :</td>
		<td class="detailesUser"><?php echo $info['lastname']; ?></td>
	</tr>
	<tr>
		<td class="detailesUser">UserName :</td>
		<td class="detailesUser"><?php echo $info['username']; ?></td>
	</tr>
	<tr>
		<td class="detailesUser">Email :</td>
		<td class="detailesUser"><?php echo $info['email']; ?></td>
	</tr>
	<tr>
		<td class="detailesUser">Phone No : </td>
		<td class="detailesUser"><?php echo $info['phoneno']; ?></td>
	</tr>

	
	<tr>
		<td class="detailesUser">Status : </td>
		<?php
		
		if($info['status'] == 1){
			$status = 'Activated';
		}else{
			$status = 'De-Activated';
		}
		?>
		<td class="detailesUser"><?php echo $status; ?></td>
	</tr>
	
	<tr>
		<td class="detailesUser">Image : </td>
		<td>
			<?php if(isset($info['user_image']) && !empty($info['user_image'])) { ?>
			<?php echo $html->image("/img/upload_userImages/".$info['user_image'] , array('width'=>'100', 'height' => '100')); ?>
			<?php } else { echo "No Image Available"; }?>
	</tr>
</table>
