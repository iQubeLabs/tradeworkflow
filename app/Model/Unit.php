<?php

App::uses('AppModel', 'Model');

/**
 * Unit Model
 */

class Unit extends AppModel {

	public $name = 'Unit';

	public $hasOne = array(
		'Trade' => array(
			'className' => 'Trade',
			'foreignKey' => 'unit_id',
			'dependent' => true,
		)
	);
}

?>