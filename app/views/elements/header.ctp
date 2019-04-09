<h1><a href="<?php echo $this->webroot; ?>fronts">Interfile Network</a></h1>
			<div id="wphead-info">
				<div id="user_info">
				<p>Welcome, 
				<a title="Edit your profile" href="<?php echo $this->webroot ?>fronts/myProfile/<?php echo $this->Session->read('userid'); ?>">Me(<?php echo $this->Session->read('Admin'); ?>)</a>
				<span class="turbo-nag hidden" style="display: inline;"> |</span> 
				<a title="Log Out" href="<?php echo $this->webroot ?>fronts/logout">Log Out</a></p>
			</div>
</div>
