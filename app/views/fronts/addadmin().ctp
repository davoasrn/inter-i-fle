<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script>
   $(function() {
	 var pickerOpts = {
        closeText: "Tutup",
        currentText: "Sekarang",
        nextText: "Seljt",
        prevText: "Seblm",
        monthNames: ["Gennaio", "feb-braio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio"," Agosto "," Settembre "," Ottobre "," Novembre "," Dicembre "],
        monthNamesShort: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Mei", "Giugno", "Luglio",
         "Ags ",' Settembre ','Ottobre','Novembre','Des'],
        dayNames: ["domenica", "Lunedi", "martedì", "mercoledì", "Giovedi",
        "venerdì", "sabato"],
        dayNamesShort: ["Sole", "Lun", "Mar", "Mer", "Gio", "Ven", "Sat"],
        dayNamesMin: ["Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
	showOn: "button",
	changeMonth: true,
        changeYear: true,
	buttonImage: "<?php echo $this->webroot;?>img/calender.png",
        isRTL: false
    };
       $( "#datepicker" ).datepicker(pickerOpts);
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
<div class="form_heading"><span class="main_heading">Amministratore Interfile Network</span></div>
<?php echo $this->Form->create('Networkadmin',array('url'=>'addadmin/')); ?>
 <div class="form_buttons">
 	<?php echo $this->Form->submit('SALVA',array('id'=>'submit','class'=>'btn','div'=>false)); ?>
 	<?php //echo $this->Form->button('ANNULLA',array('id'=>'cancel','class'=>'cancel_btn btn','div'=>false)); ?>
<div>	


<div class="form_labels_fields">
		
		<p class="label_field"><span class="label">Titolo </span><span class="field"><?php echo $this->Form->input('TITLE',array('label'=>false,'maxlength'=>'50', 'div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Cognome </span><span class="field"><?php echo $this->Form->input('SURNAME',array('label'=>false,'maxlength'=>'200','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Nome </span><span class="field"><?php echo $this->Form->input('NAME',array('label'=>false,'maxlength'=>'200','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Data di nascita </span><span class="field date_of_birth"><?php echo $this->Form->input('BIRTHDATE',array('label'=>false,'id' => 'datepicker','type' => 'text','div'=>false,'onblur' => "if(this.value==''){this.value='DD-MM-YY';}","onfocus" => "if(this.value=='DD-MM-YY'){this.value='';}","value" => "DD-MM-YY"));?></span></p>
		<p class="label_field"><span class="label">Indirizzo (residenza) </span><span class="field"><?php echo $this->Form->input('ADDRESS',array('label'=>false,'maxlength'=>'255','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">CAP (residenza) </span><span class="field"><?php echo $this->Form->input('ZIP',array('label'=>false,'maxlength'=>'10','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Provincia (residenza) </span><span class="field"><?php echo $form->input('ID_PROVINCE',array('id'=>'ID_COUNTRY','type'=>'select','options'=>$dataa,'label'=>false,'div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Città (residenza) </span><span class="field"><?php echo $form->input('ID_CITY',array('id'=>'ID_CITY','type'=>'select','label'=>false,'div'=>false,'options'=>$data)); ?></span></p>
		<p class="label_field"><span class="label">Codice Fiscale </span><span class="field"><?php echo $form->input('FISCALCODE',array('label'=>false,'div'=>false,'maxlength'=>'50')); ?></span></p>
		<p class="label_field"><span class="label">Telefono </span><span class="field"><?php echo $this->Form->input('PHONE',array('label'=>false,'maxlength'=>'30','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Fax </span><span class="field"><?php echo $this->Form->input('FAX',array('label'=>false,'maxlength'=>'30','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">E-mail </span><span class="field"><?php echo $this->Form->input('EMAIL',array('label'=>false,'maxlength'=>'100','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Username </span><span class="field"><?php echo $this->Form->input('User.USERNAME',array('label'=>false,'maxlength'=>'50','div'=>false)); ?></span><?php echo @$msgu;?></p>
		<p class="label_field"><span class="label">Password </span><span class="field"><?php echo $this->Form->input('User.PASSWORD',array('label'=>false,'type'=>'password','maxlength'=>'255','div'=>false)); ?></span><?php echo @$msgp;?></p><p class="label_field"><span class="label">Anagrafica Interfile </span><span class="field form_textarea"><?php echo $this->Form->input('INTERFILETEXT', array('type' => 'textarea',  'escape' => false,'label'=>false,'div'=>false,'maxlength'=>'255')); ?></span></p>
		
	
		</form>
</div>

