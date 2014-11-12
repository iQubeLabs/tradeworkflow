<?php
App::uses('AppModel', 'Model');
/**
 * ReceivedWebRequest Model
 *
 * @property WebRequest $WebRequest
 */
class ReceivedWebRequest extends AppModel {


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
