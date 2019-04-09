<?php
?>

      <?php echo $form->create('User', array('url'=>array('controller'=>'users','action'=>'index',)));?>
	<table>
		 <tr>
			 <td>
			
	    <span style="width:100px;">User ID:</span></td>
        <td>
          <span style="width:100px;"> <?php echo $form->input('username',array('label'=>false,'div' => false)); ?>
        </span></td>
		<Tr><td>
        <br/><span style="width:100px;">Password:</span>
		</td>
		<td>
		<span style="width:100px;"><?php echo $form->input('password',array('label'=>false,'div' => false));?></span>
		</td>
		</tr>
		<tr>
		<td colspan="2">
       
		<p> </p>
               <span style="padding-left: 89px;">  <?php echo $form->submit('Login',array('class'=>'','div'=>false, 'value'=>''));?>


      
		
		   
       </span>
	   </td>
	   </tr>
	    </table>
<?php echo $form->end();?>
    </div>


