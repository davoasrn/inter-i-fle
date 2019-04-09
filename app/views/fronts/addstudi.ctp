<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script>
   $(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
<script language="javascript">
	jQuery(document).ready(function(){
	$("#ID_COUNTRY").change(function(){
		var countryCodeVal = $('#ID_COUNTRY option:selected').val();
			
			$.ajax({
				type: 'POST',
				url : '<?php echo $this->webroot;?>fronts/findCity/'+countryCodeVal,
				success: function(msg)
				{
					$('#ID_CITY').html(msg);
				}
			});
	
		});
	});
</script>
<?php echo $this->Form->create('Studio',array('url'=>'addstudi/')); ?>
<table>
<tr>
	<td>CADICE STUDIO </td>
	<td><?php echo $this->Form->input('CODE',array('label'=>false,'maxlength'=>'25')); ?></td>
</tr>
<tr>
	<td>RAGIONE SOCIALE 1/COGNOME </td>
	<td><?php echo $this->Form->input('NAME!',array('label'=>false,'maxlength'=>'25')); ?></td>
</tr>
<tr>
	<td>RAGIONE SOCIALE 2/NOME  </td>
	<td><?php echo $this->Form->input('NAME2',array('label'=>false,'maxlength'=>'25')); ?></td>
</tr>
<tr>
	<td>INDIRIZZO</td>
	<td><?php echo $this->Form->input('ADDRESS',array('label'=>false,'maxlength'=>'50')); ?></td>
</tr>
<tr>
	<td>CAP</td>
	<td><?php echo $this->Form->input('ZIP',array('label'=>false,'maxlength' => '10')); ?></td>
</tr>
<tr>
	<td>CITTA</td>
	<td><?php echo $form->input('ID_CITY',array('id'=>'ID_CITY','type'=>'select','label'=>false,'options'=>$dataa)); ?></td>
</tr>
<tr>
	<td>TELEFONO </td>
	<td><?php echo $this->Form->input('PHONE',array('label'=>false,'maxlength'=>'15')); ?></td>
</tr>
<tr>
	<td>EMAIL </td>
	<td><?php echo $this->Form->input('EMAIL',array('label'=>false,'maxlength'=>'25')); ?></td>
</tr>
<tr>
	<td>FAX </td>
	<td><?php echo $this->Form->input('FAX',array('label'=>false,'maxlength'=>'10')); ?></td>
</tr>
<tr>
	<td>NUMERO MASSIMO PROF./COLL. </td>
	<td><?php echo $this->Form->input('MAXUSERS',array('label'=>false,'maxlength'=>'10')); ?></td>
</tr>
<tr>
	<td>SPANZIO ASSEGNATO (MB)</td>
	<td><?php echo $this->Form->input('STORAGESPACE',array('label'=>false,'maxlength'=>'10')); ?></td>
</tr>
<tr>
	<td>USERNAME</td>
	<td><?php echo $this->Form->input('USERNAME',array('label'=>false,'maxlength'=>'20')); ?></td>
</tr>
<tr>
	<td>PASSWORD</td>
	<td><?php echo $this->Form->input('PASSWORD',array('label'=>false,'maxlength'=>'20')); ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<?php echo $this->Form->checkbox('FLAGNEWS'); ?>
		<?php echo $this->Form->checkbox('FLAGFORMS'); ?>
		<?php echo $this->Form->checkbox('FLAGCOMPUTATIONS'); ?>
		<?php echo $this->Form->checkbox('FLAGGETNEWS'); ?>
	</td>
</tr>
<tr>

	<td><?php echo $this->Form->submit('Submit',array('id'=>'submit')); ?></td>
</tr>

<tr>
		<td>&nbsp;</td>
		<td><?php echo $this->Form->end(); ?></td>
</tr>
</table>
</form>
<style>
table{
width: 600px;
margin: auto;	
}
</style>
