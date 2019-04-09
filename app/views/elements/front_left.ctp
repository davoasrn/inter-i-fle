<ul id="adminmenu">
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		
		<?php echo $html->link('DashBoard', array('controller'=>'fronts', 'action' => 'dashboard'), array('escape' => false, 'class' => 'wp-first-item current menu-top menu-top-first menu-top-last', 'tabindex' => 1)); ?>
		
		
		<!--<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last " href="<?php echo $this->webroot ?>admins/dashboard/">DashBoard</a>-->
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image-admin"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<?php echo $html->link('My Details', array('controller'=>'fronts', 'action' => 'myProfile'), array('escape' => false, 'class' => 'wp-first-item current menu-top menu-top-first menu-top-last gap', 'tabindex' => 1)); ?>
		
		<!--<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/myProfile">My Details</a>-->
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image4"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<!--<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>fronts/manageUsers">User Management</a>-->
		
		<?php echo $html->link('User Management', array('controller'=>'fronts', 'action' => 'manageUsers'), array('escape' => false, 'class' => 'wp-first-item current menu-top menu-top-first menu-top-last gap', 'tabindex' => 1)); ?>
	</li>
	
	<!--<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>fronts/ManageContent">Static Pages</a>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>fronts/manageBanner">Manage Banners</a>
	</li>-->
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>fronts/logout">Logout</a>
	</li>
</ul>
