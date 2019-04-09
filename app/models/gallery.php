<?php
class Gallery extends AppModel{
	var $name = "Gallery";
    var $useTable = "galleries";
    
    var $validate = array(
		'image_title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => false,
				'message' => 'Image title can not be empty!',
			),
					'allowedCharacters'=> array(
						'rule' => '|^[a-zA-Z ]*$|',
						'message' => 'Image title can only be letters.'
					),						
					'maxLength'=> array(
						'rule' => array('maxLength', 20),
						'message' => 'Image title can not be longer than 20 characters.'
					)
		),
		'image_description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Image Description can not be empty!',
				),
				'allowedCharacters'=> array(
						'rule' => '|^[a-zA-Z ]*$|',
						'message' => 'Image Description can only be letters.'
					),						
					'maxLength'=> array(
						'rule' => array('maxLength', 100),
						'message' => 'Image Description can not be longer than 100 characters.'
					)
		),'image' => array(
            'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Invalid Image. Please upload jpeg, png, or gif file.'
        ),

	
	);

}
