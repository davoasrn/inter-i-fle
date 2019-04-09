<?php
class Networkadmin extends AppModel{
	var $name = "Networkadmin";
    var $useTable = "NETWORKADMIN";
  
  var $primaryKey	= 'ID';
    
    var $validate = array(
						'SURNAME' => array('alphaNumeric' => array('rule' => 'notempty',
											'required' => true,
											'message' => 'Il campo non deve essere vuoto',
											'last' => true
											)
										      /* array('rule' => 'alphaNumeric',
											'required' => true,
											'message' => 'Solo lettere e numeri'
											)*/
										),
						/*'USERNAME' => array('alphaNumeric' => array('rule' => 'notempty',
											'required' => true,
											'message' => 'Il campo non deve essere vuoto',
											'last' => true
											),
										      array('rule' => 'alphaNumeric',
											    'required' => false,
											     'message' => 'Solo lettere e numeri'
											  ),
										    array('rule' => 'isUnique',
											  'message' => 'Esiste già questo nome utente'
															)),
						'PASSWORD' => array('alphaNumeric' => array('rule' => 'notempty',
											'required' => true,
											'message' => 'Il campo non deve essere vuoto',
											'last' => true
											),
											array('rule' => 'alphaNumeric',
											      'required' => false,
											       'message' => 'Il campo non deve essere vuoto'
											)),*/
						'EMAIL' => array('email' => array('rule' => 'notempty',
											'required' => true,
											'message' => 'Il campo non deve essere vuoto',
											'last' => true
											),
									    array('rule' => 'email',
										'required' => true,
										'message' => 'Inserisci un indirizzo email valido'
										),
										array('rule' => 'isUnique',
										     'message' => 'Questo indirizzo e-mail è già associato a un altro account.
'
									))
					); 
			 var $belongsTo = array('User' => array(      
							'className'    => 'User', 
							 'foreignKey'  => 'ID_USER'  
					      ) 
					   );  
}
