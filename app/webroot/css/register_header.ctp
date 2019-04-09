<div id="header_pnl">
    <div class="wrapper">
    <p class="logo"><a href="<?php echo $this->webroot; ?>"><img src="<?php echo $this->webroot; ?>images/dot.gif" alt="logo" /></a></p>
    <div class="heade_rt">
                <div class="login">
                <?php
			$isLogged = $this->Session->read("loggedin");
			if(@$isLogged != '1'){
		?>
		<p class="sign_up"><a href="<?php echo $this->webroot; ?>fronts/register">Sign Up</a></p>
		<?php	
			}else{
				$cartCount=$this->Session->read('basket');

				echo "<div class='cart-wrapper'>Shopping Cart: <a href='".$this->webroot."cart/' title='Click to view your Shopping Basket'>".count($cartCount['items'])." item(s)"."</a></div>";
			}
		?>
        
		<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='1'){ ?>
			 <p class="log_out"> <span><a href="<?php echo $this->webroot; ?>fronts/logout">Log Out</a></span><span><a href="<?php echo $this->webroot; ?>fronts/contact">Contact Us</a></span>  </p>
				<?php
				$redirect = ($_SESSION['userInfo']['usertype_id']=='1') ? 'buyers' : 'sellers';
				?><br><br><p style="margin-left:180px;margin-top: 10px;"><strong style="color: #808080;">Logged in  :</strong><a style="color:#0000FF;font-weight:bold;" href="<?php echo $this->webroot.$redirect; ?>">(<?php echo $_SESSION['userInfo']['firstname']." ".$_SESSION['userInfo']['lastname'];?>)</a></p>

				<?php }
				 elseif(empty($_SESSION['loggedin'])) {?>
<p class="log_out"> <span><a href="<?php echo $this->webroot; ?>fronts/login">Login</a></span> <span><a href="<?php echo $this->webroot; ?>fronts/contact">Contact Us</a></span> </p>
				<?php }?>

</p>
      </div>
        <div class="nav">

		<?php 	
	if($this->params['controller']=='fronts' && $this->params['action'] =='register'){	
	?>
        <ul>
<li><a href="<?php echo $this->webroot; ?>fronts/basic" class="tab"  title="How it Works">How it Works</a></li>
            <li><a href="<?php echo $this->webroot; ?>fronts/purchase" class="tab" title="Medical Centers">Medical Centers</a></li>
            <li><a href="<?php echo $this->webroot; ?>fronts/seller" class="tab" title="Device Companies">Device Companies</a></li>
	 <li><a href="<?php echo $this->webroot; ?>cms/index/2" class="tab" title="Company Overview">Company Overview</a></li>
            <!--li><a href="<?php echo $this->webroot; ?>fronts/investor" class="tab">Investors</a></li-->
          </ul>
	 <?php 
	    }
	    ?>

        <ul>

      </div>
      </div>
  </div>
  </div>

<div id="nav_pnl">
    <div class="wrapper">
    
  </div>
  </div>
