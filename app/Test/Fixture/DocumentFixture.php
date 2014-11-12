<?php
/**
 * DocumentFixture
 *
 */
class DocumentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'courier_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'trade_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'tracking_number' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'shipping_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'expected_arrival_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_delete' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'courier_id' => array('column' => 'courier_id', 'unique' => 0),
			'trade_id' => array('column' => 'trade_id', 'unique' => 0)
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
			'courier_id' => 1,
			'trade_id' => 1,
			'tracking_number' => 'Lorem ipsum dolor sit amet',
			'shipping_date' => '2014-07-01 11:38:40',
			'expected_arrival_date' => '2014-07-01 11:38:40',
			'date_created' => '2014-07-01 11:38:40',
			'date_updated' => '2014-07-01 11:38:40',
			'date_delete' => '2014-07-01 11:38:40'
		),
	);

}
