<?php
App::uses('AppModel', 'Model');
/**
 * Log Model
 *
 * @property Account $Account
 */
class Log extends AppModel {


    //list of actions to be logged
    public static $ENUM_ACTION = array(
        
    );
    
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Customer',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
