<?php
class Banner extends AppModel{
    var $name = "Banner";
    var $validate = array(
		'banner_name' => array(
			'notempty' => array(
			'rule' => array('notempty'),
			'required' => false,
			'message' => 'Banner name can not be empty!',
			),						
					'maxLength'=> array(
						'rule' => array('maxLength', 20),
						'message' => 'Banner Name can not be longer than 20 characters.'
					)
		),
		'banner_link' => array(
			'notempty' => array(
			'rule' => array('notempty'),
			'required' => false,
			'message' => 'Banner link can not be empty!',
			),						
				'website'=> array(
				'rule' => array('url', true),
				'message' => 'Banner link is invalid.'
				)
		)
	);

}
