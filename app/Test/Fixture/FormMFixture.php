<?php
/**
 * FormMFixture
 *
 */
class FormMFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'form_m';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'primary'),
		'registration_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'expiration_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'seller_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'loading_port_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'discharge_port_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'good_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'hs_code' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fob_value' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'freight_value' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'insurance_value' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mode_of_payment' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_deleted' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'seller_id' => array('column' => 'seller_id', 'unique' => 0),
			'loading_port_id' => array('column' => 'loading_port_id', 'unique' => 0),
			'discharge_port_id' => array('column' => 'discharge_port_id', 'unique' => 0),
			'good_id' => array('column' => 'good_id', 'unique' => 0)
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
			'registration_date' => '2014-07-01 11:38:40',
			'expiration_date' => '2014-07-01 11:38:40',
			'seller_id' => 1,
			'loading_port_id' => 1,
			'discharge_port_id' => 1,
			'good_id' => 1,
			'hs_code' => 'Lorem ipsum dolor sit amet',
			'fob_value' => 'Lorem ipsum dolor sit amet',
			'freight_value' => 'Lorem ipsum dolor sit amet',
			'insurance_value' => 'Lorem ipsum dolor sit amet',
			'mode_of_payment' => 1,
			'date_created' => '2014-07-01 11:38:40',
			'date_updated' => '2014-07-01 11:38:40',
			'date_deleted' => '2014-07-01 11:38:40'
		),
	);

}
