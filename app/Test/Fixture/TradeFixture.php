<?php
/**
 * TradeFixture
 *
 */
class TradeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'date_added' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'expiry_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'form_m_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_deleted' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'customer_id' => array('column' => 'customer_id', 'unique' => 0),
			'form_m_id' => array('column' => 'form_m_id', 'unique' => 0),
			'id' => array('column' => 'id', 'unique' => 0)
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
			'date_added' => '2014-07-01 11:38:42',
			'expiry_date' => '2014-07-01 11:38:42',
			'customer_id' => 1,
			'form_m_id' => 1,
			'date_created' => '2014-07-01 11:38:42',
			'date_updated' => '2014-07-01 11:38:42',
			'date_deleted' => '2014-07-01 11:38:42'
		),
	);

}
