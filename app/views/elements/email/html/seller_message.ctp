<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

<body>
	<div class="wrapper"> 
		<div style="width:100%; float:left">
			<div class="logo">
				<a href="<?php echo LIVE_SITE; ?>">
					<img alt="logo" src="<?php echo LIVE_SITE; ?>/img/images/logo.png">
				</a>
			</div>
		</div>
		<div  style="height:15px; background-color:#0082C5; width: 100%; float:left;"></div>
		<div  style="width: 100%; float:left;" id="Contents">
		 <!--div style="float: left;font-size: 30px; width: 100%; color: #606161; text-align:center">A MEDTECH MARKET.  DONE SMARTER.</div-->
		 <div style="float: left;font-size: 18px; width: 100%; color: #606161; text-align:left; line-height: 30px;">
		 Hello <?php echo $orderDetails[0]['u']['firstname'].' '.$orderDetails[0]['u']['lastname'];?>, 
		 <br>
		 <?php echo $orderDetails[0]['u']['companyname']; ?> has received an order ( Order id : <?php echo $orderDetails[0]['o']['id'];?>) through OrthoPort.</div>
		 <div style="float: left;font-size: 18px; width: 100%; color: #0082C5; text-align:left; ">
		 you can login to your account for managing orders. <a href="<?php echo LIVE_SITE; ?>/fronts/login" target="_blank">Click to Login</a></div>
		 <!--table border="0" cellspacing="2" cellpadding="2" width="100%" align="center">
			<tr>
				<td width="33%" style="text-align:center">
					<a href="<?php echo LIVE_SITE; ?>/fronts/basic">
						<img src="<?php echo LIVE_SITE; ?>/images/pic22.png" align="center" style=" border: 2px double gray; padding: 3px;">
					</a>
				</td>
				<td width="33%" style="text-align:center">
					<a href="<?php echo LIVE_SITE; ?>/fronts/basic">
						<img src="<?php echo LIVE_SITE; ?>/images/pic1.png" align="center" style=" border: 2px double gray; padding: 3px;">
					</a>
				</td>
				<td width="33%" style="text-align:center">
					<a href="<?php echo LIVE_SITE; ?>/fronts/basic">
						<img src="<?php echo LIVE_SITE; ?>/images/pic33.png" align="center" style=" border: 2px double gray; padding: 3px;">
					</a>
				</td>
			</tr>
		 </table-->
		 
		  <div style="float:left; margin:10px 0px; border:solid 2px 0082C5; width:100%">
			 <table border="1" cellspacing="2" cellpadding="2" width="100%" align="center">
				<tr>
					<td width="50%" style="vertical-align:top;">
						<table border="0" cellspacing="2" cellpadding="2" width="100%">
							<tr>
								<td colspan="2" style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Medical Center Contact Information</td>
							</tr>
							<tr>
								<td>Name :</td>
								<td><?php echo $orderDetails[0]['o']['mc_name'];?></td>
							</tr>
							<tr>
								<td>Title :</td>
								<td><?php echo $orderDetails[0]['o']['mc_title'];?></td>
							</tr>
							<tr>
								<td>Email :</td>
								<td><?php echo $orderDetails[0]['o']['mc_email'];?></td>
							</tr>
							<tr>
								<td>Office Phone :</td>
								<td><?php echo $orderDetails[0]['o']['mc_phone'];?></td>
							</tr>
							<tr>
								<td>Mobile Phone :</td>
								<td><?php echo $orderDetails[0]['o']['mc_mobile'];?></td>
							</tr>
						 </table>		
					</td>
					<td width="50%" style="vertical-align:top;">
						<table border="0" cellspacing="2" cellpadding="2" width="100%">
							<tr>
								<td colspan="2" style="text-align:center; color:#FFFFFF; background-color:#0082C5">Shipping Address</td>
							</tr>
							<tr>
								<td>Medical Center Name :</td>
								<td><?php echo $orderDetails[0]['o']['ship_mc_name'];?></td>
							</tr>
							<tr>
								<td>Address :</td>
								<td><?php echo $orderDetails[0]['o']['ship_address'];?></td>
							</tr>
							<tr>
								<td>Shipping Notes :</td>
								<td><?php echo $orderDetails[0]['o']['ship_notes'];?></td>
							</tr>
							<tr>
								<td>Order Placed at : </td>
								<td><?php echo $orderDetails[0]['o']['order_date'];?></td>
							</tr>
						</table>
					</td>
				</tr>
			 </table>
			 
		 </div>
		 
		 <div style="float:left; margin:10px 0px; border:solid 2px 0082C5; width:100%">
			 <table border="1" cellspacing="0" cellpadding="0" width="100%" align="center">
				<tr>
					<td width="100%" style="vertical-align:top;">
						<table border="1" cellspacing="2" cellpadding="2" width="100%">
							<tr>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Product Image</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Company</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Product Name</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Category</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Surgery Date</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Surgery Time</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Surgeon</td>
								<td style="text-align:center; color:#FFFFFF; background-color:#0082C5;">Quantity</td>
							</tr>
							<?php
							//pr($orderDetails);
							foreach($orderDetails as $key => $value){
							?>
							<tr>
								<td style="text-align:center;">
									<img src="<?php echo LIVE_SITE; ?>/img/productImages/thumbs/<?php echo $value['p']['thumbimg'];?>" width="50" height="50" />
								</td>
								<td style="text-align:center;"><?php echo $value['u']['companyname'];?>&nbsp;</td>
								<td style="text-align:center;"><?php echo $value['p']['name'];?>&nbsp;</td>
								<td style="text-align:center;">
									<?php 
									if(count($value['category'])>0){
										$cats = array();
										foreach($value['category'] as $cat){
											$cats[] = $cat['name'];
										}
										echo implode(', ', $cats);
									}
									?>&nbsp;
								</td>
								<td style="text-align:center;"><?php echo $value['op']['s_date'];?>&nbsp;</td>
								<td style="text-align:center;"><?php echo $value['op']['s_time'];?>&nbsp;</td>
								<td style="text-align:center;"><?php echo $value['op']['surgeon'];?>&nbsp;</td>
								<td style="text-align:center;"><?php echo $value['op']['quantity'];?>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="8" style="text-align:left; background-color:#0095E6; color:#ffffff;"><strong>Special Notes :</strong> <?php echo $value['op']['note'];?>&nbsp;</td>
							</tr>
							<?php
							}?>
							
						</table>		
					</td>				
				</tr>
			 </table>
			 
		 </div>
		 
		 
		 
		</div>
		<div  style="height:20px; background-color:#0082C5; width: 100%; float:left;"></div>
	</div>
</body>
</html>
