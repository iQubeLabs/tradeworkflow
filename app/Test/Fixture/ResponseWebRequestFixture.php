<?php
/**
 * ResponseWebRequestFixture
 *
 */
class ResponseWebRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'primary'),
		'web_request_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'response' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'web_request_id' => 1,
			'response' => 1,
			'date_created' => '2014-07-01 11:38:41'
		),
	);

}
