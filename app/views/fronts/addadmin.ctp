<?php 
echo $javascript->link('jquery_ui.js');
echo $this->Html->css('jquery_ui.css');
echo $javascript->link('ckeditor/ckeditor.js');
?>
<script>
   $(function() {
	var pickerOpts = {
        closeText: "Tutup",
        currentText: "Sekarang",
        nextText: "Successivo",
        prevText: "Precedente",
        monthNamesShort: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio"," Agosto "," Settembre "," Ottobre "," Novembre "," Dicembre "],
        monthNames: ["GEN", "FEB", "MAR", "APR", "MAG", "GIU", "LUG","AGO "," SET ","OTT","NOV","DIC"],
        dayNames: ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì","Venerdì", "Sabato"],
        dayNamesShort: ["DOM", "LUN", "MAR", "MER", "GIO", "VEN", "SAB"],
        dayNamesMin: ["D", "L", "MA", "ME", "G", "V", "S"],
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
	showOn: "button",
	changeMonth: true,
        changeYear: true,
	buttonImage: "<?php echo $this->webroot;?>img/calender.png",
        isRTL: false,
	yearRange: "1900:"
    };
       $( "#datepicker" ).datepicker(pickerOpts);
});
$(document).ready(function(){
		$('.datepicker_close').click(function(){
		  $('.datepicker_close').val('DD-MM-YYYY');
	    });
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


 function showMe() 
{
	var NetworkadminSURNAME =  $('#NetworkadminSURNAME');
	var NetworkadminNAME =  $('#NetworkadminNAME');
	var UserUSERNAME  =  $('#UserUSERNAME');
      	UserUSERNAME.val(NetworkadminNAME.val()+'.'+NetworkadminSURNAME.val());	
}
</script>
<div class="form_heading"><span class="main_heading main_heading1">Amministratore Interfile Network</span></div>
<?php echo $this->Form->create('Networkadmin',array('url'=>'addadmin/')); ?>
 <div class="form_buttons">
 	<span class="submit_btn"><?php echo $this->Form->submit('Salva',array('id'=>'submit','class'=>'btn','div'=>false)); ?></span>
 	<!--<span class="cancel_btn"><?php echo $this->Form->button('Annulla', array('type'=>'reset','class' => 'btn','div'=>false));?></span>-->
<div>	


<div class="form_labels_fields">
		
		<p class="label_field"><span class="label">Titolo </span><span class="field"><?php echo $this->Form->input('TITLE',array('label'=>false,'maxlength'=>'50', 'div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Cognome </span><span class="field"><?php echo $this->Form->input('SURNAME',array('label'=>false,'maxlength'=>'200','div'=>false,'onkeyup' => "showMe();")); ?></span></p>
		<p class="label_field"><span class="label">Nome </span><span class="field"><?php echo $this->Form->input('NAME',array('label'=>false,'maxlength'=>'200','div'=>false,'onkeyup' => "showMe();")); ?></span></p>
		<p class="label_field"><span class="label">Data di nascita </span><span class="field date_of_birth"><?php echo $this->Form->input('BIRTHDATE',array('label'=>false,'id' => 'datepicker','class' => 'datepicker_close' ,'type' => 'text','div'=>false,'onblur' => "if(this.value==''){this.value='DD-MM-YYYY';}","onfocus" => "if(this.value=='DD-MM-YYYY'){this.value='';}","value" => "DD-MM-YYYY",'readonly'=>true));?></span></p>
		<p class="label_field"><span class="label">Indirizzo (residenza) </span><span class="field"><?php echo $this->Form->input('ADDRESS',array('label'=>false,'maxlength'=>'255','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">CAP (residenza) </span><span class="field"><?php echo $this->Form->input('ZIP',array('label'=>false,'maxlength'=>'10','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Provincia (residenza) </span><span class="field"><?php echo $form->input('ID_PROVINCE',array('id'=>'ID_COUNTRY','type'=>'select','options'=>$dataa,'label'=>false,'div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Città (residenza) </span><span class="field"><?php echo $form->input('ID_CITY',array('id'=>'ID_CITY','type'=>'select','label'=>false,'div'=>false,'options'=>$data)); ?></span></p>
		<p class="label_field"><span class="label">Codice Fiscale </span><span class="field"><?php echo $form->input('FISCALCODE',array('label'=>false,'div'=>false,'maxlength'=>'50')); ?></span></p>
		<p class="label_field"><span class="label">Telefono </span><span class="field"><?php echo $this->Form->input('PHONE',array('label'=>false,'maxlength'=>'30','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Fax </span><span class="field"><?php echo $this->Form->input('FAX',array('label'=>false,'maxlength'=>'30','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">E-mail </span><span class="field"><?php echo $this->Form->input('EMAIL',array('label'=>false,'maxlength'=>'100','div'=>false)); ?></span></p>
		<p class="label_field"><span class="label">Username </span><span class="field"><?php echo $this->Form->input('User.USERNAME',array('label'=>false,'maxlength'=>'50','div'=>false)); ?></span><?php echo @$msgu;?></p>
		<p class="label_field"><span class="label">Password </span><span class="field"><?php echo $this->Form->input('User.PASSWORD',array('label'=>false,'type'=>'password','maxlength'=>'255','div'=>false,'autocomplete' => "off")); ?></span><?php echo @$msgp;?></p>
		<p class="label_field"><span class="label">Anagrafica Interfile </span><span class="field form_textarea"><?php echo $this->Form->input('INTERFILETEXT', array('type' => 'textarea', 'class' => 'ckeditor', 'escape' => false,'autocomplete' => "off",'label'=>false,'div'=>false,'maxlength'=>'255','value' => 'Castegnaro s. r. l.<br>Via S. Macro, 4 - 36051 Creazzo (VICENZA) - ITALY.<br>Tel. 0444.371.220 - Fax: 0444.278.133 - E-mail: csc@interfile.it')); ?></span></p>
		
	
		</form>
</div>

