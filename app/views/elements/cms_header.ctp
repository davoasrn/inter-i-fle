<div class="wrapper"> 
  <!--header starts here-->
  <div class="header">
    <div class="logo">
 <?php echo $this->Html->link($this->Html->image("images/logo.png", array("alt" => "Logo")),"../fronts/index",array('escape' => false));
?>

</div>
    <div class="register">
         
		 <div class="acc_btn"><a href="register"><span>Create An Account</span></a></div>     
		 
    </div>
  </div>
  <!--header ends here--> 
</div>
<!--wrapper ends here--> 

<!--nav_wrapper starts here-->
<div id="nav_wrapper"> 
  <!--wrapper starts here-->
  <div class="wrapper"> 
    <!--site_navigation starts here-->
    <div id="site_navigation">
      <ul>
        <li id="homepage" class="selected"><a href="<?php echo $this->webroot ?>fronts/index">Home</a></li>
        <li><a href="javascript:void(0);"><span>HOW IT WORKS</span></a></li>
        <li><a href="javascript:void(0);"><span>PURCHASE</span></a></li>
        <li><a href="javascript:void(0);"><span>SELL</span></a></li>
      </ul>
    </div>
    <!--site_navigation ends here--> 
  </div>
  <!--wrapper ends here--> 
</div>


