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
<?php $string = '';
$string .= '<div  style="height:15px; background-color:#0082C5; width: 100%; float:left;"></div>
			<div  style="width: 100%; float:left;" id="Contents">';
	$string .='Gentile cliente,<br/> <br/>';
	$string .='Di seguito sono riportati username e password per accedere al INTERFILE network.<br/> <br/>';
	$string .='Dati di login:<br/>';
	$string .= 'Username:&nbsp;'.$userDetail['User']['USERNAME'].'<br/>';
	$string .= 'Password:&nbsp;'.$userDetail['User']['PASSWORD'].'<br/><br/>';
	$string .= 'Ti invitiamo a conservarli in un luogo sicuro.<br/><br/>';
	$string .= 'Il team di INTERFILE';
	$string .= '</div>
		        <div  style="height:20px; background-color:#0082C5; width: 100%; float:left;"></div>
                </div>';
echo $string;
?>

