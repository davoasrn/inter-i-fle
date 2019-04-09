<?php

class Admin extends AppModel
{
          var $name = "Admin";
          
          var $validate = array(  'user' =>array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter user name.',
				'last' => true
			)),'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter login password.',
				'last' => true
			)));
          
          
          function validate_login($inputData)
          {	         
                   $conditions = array('Admin.username'=>$inputData['Admin']['user'],'Admin.password'=>md5($inputData['Admin']['password']));  
                   $admin_detail = $this->find('first', array('conditions'=>$conditions));
                   
                   if(!empty($admin_detail))
                   {
                             $salt = Configure::read('Security.salt');
                             if($admin_detail['Admin']['password'] == md5($inputData['Admin']['password']))
                             {
                                       return $admin_detail;
                             }
                   }
                   return false;
          }
}



?>
