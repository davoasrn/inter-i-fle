<script type="text/javascript">
function logOut()
{

var r=confirm("Confermi uscita?");
if (r==true)
  {
    window.location = "<?php echo $this->webroot ?>fronts/logout";
  }
}
</script>
<script type="text/javascript">
   $("a#fancyBoxLink").fancybox({
        'href'   : '#myDivID',
        'titleShow'  : false,
        'transitionIn'  : 'elastic',
        'transitionOut' : 'elastic'
        
    });
    function SI()
    {
		 window.location = "<?php echo $this->webroot ?>fronts/logout";
	}
    function NO()
    {
		 window.location = "<?php echo $this->webroot ?>fronts/admin_home";
	}
</script>
<div class="header">
  <div class="top_container">
  <?php echo $this->Html->link($this->Html->image('LogoRC_Original.gif',array('escape'=>false, 'height'=>"68")).$this->Html->image('logo.jpg',array('escape'=>false)),array(),array('escape'=>false,'class'=>"logo"));?>
  <div class="addr"><span class="breaktext"><?php echo $this->Session->read('Networkadmin.INTERFILETEXT')?><!--Centro Studi Castegnaro s. r. l.<br />Via S. Macro, 4 - 36051 Creazzo (VICENZA) - ITALY.<br/>Tel. 0444.371.220 - Fax: 0444.278.133 - E-mail: csc@interfile.it--></span></div></div>
  </div>
  <div class="menu">
    <div class="menu_container">
      <ul class="nav"><li><a class="studi" href="#">Studi</a></li><li><a href="#">Documenti</a></li><li><a class="admin_home" href="admin_home">Amministratori</a></li><li><a href="#">Cartelle</a></li><li><a href="#">Impostazioni</a></li>
      </ul>
      <div class="right_menu_options">
	<ul><li class="user"><?php echo $this->Html->image('usericon.png');?><?php echo substr($this->Session->read('Networkadmin.NAME')."&nbsp;".$this->Session->read('Networkadmin.SURNAME'),'0','60') ?><br/>(AMMINISTRATORE NETWORK)</li>
	<li class="email_li"><?php echo $this->Html->image('emailicon.png');?>"n" Nuovi</li>
	<li class="right_arrow"><a href="#myDivID" id="fancyBoxLink"><?php echo $this->Html->image('right_arrow.png');?></a></li>
	</ul>
      </div>
     </div>
  </div>
</div>
<div style="display:none">
    <div id="myDivID">
		
         <div class="confirm_error_msg">Confermi uscita?</div>
		 <div class="confirm_box">
			  <input id="submit" class="btn" onclick="SI();" type="submit" value="SI&nbsp;">
			  <input id="submit" class="btn" onclick="NO()" type="submit" value="NO">
		      
		</div>
		
    </div>
</div>
