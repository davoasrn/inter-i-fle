<?php 
//echo $javascript->link('fancybox/jquery.fancybox.js?v=2.1.0');
//echo $this->Html->css('fancybox/jquery.fancybox.css?v=2.1.0');
?>
<?php
//pr($detail);die;
echo $this->Session->flash();
?>
<div class="form_heading">
<span class="main_heading">GESTIONE AMMINISTRATORI INTERFILE NETWORK </span><a class="add fancybox fancybox.iframe" href="<?php echo $this->webroot ?>fronts/addadmin"><span class="button1 btn"><?php echo $this->Html->image('plus_img.png')?>Aggiungi</span></a>
</div>
<div class="form_labels_fields">
<table class="table_data" rules="groups" cellpadding="0" cellspacing="0">
<tr>
<th>TITOLO</th><th><?php echo $this->Paginator->sort('NOME','NAME'); ?></th><th><?php echo $this->Paginator->sort('COGNOME','SURNAME'); ?></th><th>TELEFONO</th><th>FAX</th><th>E-MAIL</th><th>AZIONE</th></tr>
<?php 
foreach( $detail as $key=>$val):?>
<tr>
	<td><?php echo $val['Networkadmin']['TITLE'];?></td>
	<td><?php echo wordwrap($val['Networkadmin']['NAME'], 50, "<br />\n");?></td>
	<td><?php echo wordwrap($val['Networkadmin']['SURNAME'], 50, "<br />\n");?></td>
	<td><?php echo $val['Networkadmin']['PHONE'];?></td>
	<td><?php echo $val['Networkadmin']['FAX'];?></td>
	<td><?php echo $val['Networkadmin']['EMAIL'];?></td>
	<td class="no-border_right"><a class="fancybox fancybox.iframe" href="<?php echo $this->webroot; ?>fronts/editadmin/<?php echo $val['User']['ID'];?>"><?php echo $this->Html->image('edit_icon.png')?></a>&nbsp;&nbsp;&nbsp;
	<a href="#"><?php echo $this->Html->image('del_icon.png')?></a></td>
</tr>
<?php endforeach; ?>
<tr>
  <td colspan='7' align='center'><!-- Shows the page numbers -->
<?php echo $this->Paginator->numbers(); ?>
<!-- Shows the next and previous links -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Paginator->prev('« Precedente', null, null, array('class' => 'disabled')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $this->Paginator->next('Successivo »', null, null, array('class' => 'disabled')); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- prints X of Y, where X is current page and Y is number of pages -->
<?php echo $this->Paginator->counter(array(    'format' => 'pagina %page% di %pages%')); ?></td>
</tr>
</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('a.fancybox').click(function() { 
		$('.fancybox').fancybox();
		});
	$('ul.nav li a').removeClass('active');
	$('a.admin_home').addClass('active');
});
</script>
<script>
function myFunction()
{
var x;
var r=confirm("Are you sure? you want to the delete the user please select option yes or no");
if (r==true)
  {
	return true;
  }
else
  {
	return false;
  }
}
</script>
