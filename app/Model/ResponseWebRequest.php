<?php
App::uses('AppModel', 'Model');
/**
 * ResponseWebRequest Model
 *
 * @property WebRequest $WebRequest
 */
class ResponseWebRequest extends AppModel {

    /**
     * Enum for response
     */
    public static $ENUM_RESPONSE = array(
        "1" => 0,
        "2" => 1,
        "3" => 2
    );
    
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'WebRequest' => array(
			'className' => 'WebRequest',
			'foreignKey' => 'web_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
