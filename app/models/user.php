<?php

class User extends AppModel
{
          var $name = "User";
		  var $useTable	= 'USER';	
          var $validate = array(
			'username' =>array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'Please enter user name.',
					'last' => false
				)),
				'password' => array(
						'notempty' => array(
						'rule' => array('notempty'),
						'message' => 'Please enter login password.',
						'last' => false
				)),
				'USERNAME' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Please enter login password.',
							'last' => false
					),
					/*'alphaNumeric' => array('rule' => 'alphaNumeric',
								'required' => false,
								'message' => 'Solo lettere e numeri'
								),*/
						array('rule' => 'isUnique',
								'required' => false,
								'on' => 'create',
								'message' => 'Esiste già questo nome utente'
						)),
				'PASSWORD' => array('notempty' => array('rule' => 'notempty',
									'required' => false,
									'message' => 'Il campo non deve essere vuoto',
									'allowEmpty' =>false     
								  ))
			);
          
          var $hasOne = array(        
						'Networkadmin' => array(            
							'className'    => 'Networkadmin',            
							'foreignKey'    => 'ID_USER'  
						    )   
						   );  
          
          //var $belongsTo=array('Networkadmin',array('foreignKey'=>'networkadmin_id'));
          
          function validate_login($inputData)
          {	         
				   pr($inputData);die('hrer');
                   $conditions = array('User.USERNAME'=>$inputData['Admin']['user'],'Admin.password'=>md5($inputData['Admin']['password']));  
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
