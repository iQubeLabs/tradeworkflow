<?php
/**
 * ResponseSmsRequestFixture
 *
 */
class ResponseSmsRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'primary'),
		'sms_request_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'response' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'sms_request_id' => array('column' => 'sms_request_id', 'unique' => 0)
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
			'sms_request_id' => 1,
			'response' => 'Lorem ipsum dolor sit amet',
			'date_created' => '2014-07-01 11:38:41'
		),
	);

}
