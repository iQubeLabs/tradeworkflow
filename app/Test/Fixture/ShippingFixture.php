<?php
/**
 * ShippingFixture
 *
 */
class ShippingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'loading_port_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'discharge_port_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'trade_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'shipping_line_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'shipping_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'expected_arrival_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'dated_delete' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'loading_port_id' => 1,
			'discharge_port_id' => 1,
			'trade_id' => 1,
			'shipping_line_id' => 1,
			'shipping_date' => '2014-07-01 11:38:41',
			'expected_arrival_date' => '2014-07-01 11:38:41',
			'date_created' => '2014-07-01 11:38:41',
			'date_updated' => '2014-07-01 11:38:41',
			'dated_delete' => '2014-07-01 11:38:41'
		),
	);

}
