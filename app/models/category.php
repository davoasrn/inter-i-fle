<?php
class Category extends AppModel{
	var $name= 'Category';
	var $actsAs = array('Containable');
	var $validate = array(
					'name' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'message' => 'Name can Not be empty.'
							  ),
	
							
					);







}
