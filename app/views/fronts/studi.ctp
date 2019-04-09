<script src="<?php echo $this->webroot ?>fancybox/jquery.fancybox.js?v=2.1.0"></script>
<style href="<?php echo $this->webroot ?>fancybox/jquery.fancybox.css?v=2.1.0"></style>

<?php
//pr($detail);die;
echo $this->Session->flash();
?>
<div>
<p><p><span class="main_heading">GESTIONE SOCIETA'DI SERVIZI E STUDI PROFESSIONALI</span></p><a class="add " href="<?php echo $this->webroot ?>fronts/addstudi"><button class="btn">Aggiungi</button></a>
</div>
<table class="table_data" rules="groups" cellpadding="0" cellspacing="0">
<tr>
<th>RAGIONE SOCIALE 1</th><th>RAGIONE SOCIALE 2</th><th>INDIRIZZO</th><th>CAP</th><th>CITTA</th><th>PROVINCIA</th><th>TELEFONO</th><th>E-MAIL</th><th>ACTION</th></tr>
<?php 
foreach ($detail as $key=>$val) :
?>
<tr>
<td><?php echo $val['Studio']['CODE'];?></td>
<td><?php echo $val['Studio']['NAME1'];?></td>
<td><?php echo $val['Studio']['NAME2'];?></td>
<td><?php echo $val['Studio']['ADDRESS'];?></td>
<td><?php echo $val['Studio']['ZIP'];?></td>
<td><?php echo $val['Studio']['ID_CITY'];?></td>
<td><?php echo $val['Studio']['PHONE'];?></td>
<td><?php echo $val['Studio']['EMAIL'];?></td>
<td><a class="fancybox fancybox.iframe" href="<?php echo $this->webroot; ?>fronts/editstudi/<?php echo $val['Studio']['ID'];?>">Edit</a>&nbsp;&nbsp;&nbsp;
	<a onclick="return myFunction();" href="<?php echo $this->webroot; ?>fronts/deletestudi/<?php echo $val['Studio']['ID'];?>">Delete</a></td>
</tr>

<?php endforeach; ?>


</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('a.fancybox').click(function() { 
		$('.fancybox').fancybox();
		});
	$('ul.nav li a').removeClass('active');
	$('a.studi').addClass('active');
	});
</script>
<script>
function myFunction()
{
var x;
var r=confirm("Press a button!");
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
