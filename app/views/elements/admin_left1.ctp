<ul id="adminmenu">
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		
		<?php echo $html->link('DashBoard', array('controller'=>'admins', 'action' => 'dashboard'), array('escape' => false, 'class' => 'wp-first-item current menu-top menu-top-first menu-top-last', 'tabindex' => 1)); ?>
		
		
		<!--<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last " href="<?php echo $this->webroot ?>admins/dashboard/">DashBoard</a>-->
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image-admin"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<?php echo $html->link('My Details', array('controller'=>'admins', 'action' => 'myProfile'), array('escape' => false, 'class' => 'wp-first-item current menu-top menu-top-first menu-top-last gap', 'tabindex' => 1)); ?>
		
		<!--<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/myProfile">My Details</a>-->
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image4"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<!--<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/manageUsers">User Management</a>-->
		
		<?php echo $html->link('User Management', array('controller'=>'admins', 'action' => 'manageUsers'), array('escape' => false, 'class' => 'wp-first-item current menu-top menu-top-first menu-top-last gap', 'tabindex' => 1)); ?>
	</li>
	
	<!--<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/ManageContent">Static Pages</a>
	</li>
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/manageBanner">Manage Banners</a>
	</li>-->
	<li id="menu-dashboard" class="wp-first-item menu-top menu-top-first menu-top-last">
		<div class="wp-menu-image3"><a href="index.php"><br></a></div>
		<div class="wp-menu-toggle" style="display: none;"><br></div>
		<a tabindex="1" class="wp-first-item current menu-top menu-top-first menu-top-last gap" href="<?php echo $this->webroot ?>admins/logout">Logout</a>
	</li>
</ul>
