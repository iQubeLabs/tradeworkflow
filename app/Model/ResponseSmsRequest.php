<?php
App::uses('AppModel', 'Model');
/**
 * ResponseSmsRequest Model
 *
 * @property SmsRequest $SmsRequest
 */
class ResponseSmsRequest extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SmsRequest' => array(
			'className' => 'SmsRequest',
			'foreignKey' => 'sms_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
