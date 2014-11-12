<?php
/**
 * ReceivedWebRequestFixture
 *
 */
class ReceivedWebRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'primary'),
		'web_request_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'request' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_delete' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'request' => 'Lorem ipsum dolor sit amet',
			'date_created' => '2014-07-01 11:38:41',
			'date_updated' => '2014-07-01 11:38:41',
			'date_delete' => '2014-07-01 11:38:41'
		),
	);

}
