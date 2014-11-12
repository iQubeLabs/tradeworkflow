<?php
App::uses('Port', 'Model');

/**
 * Port Test Case
 *
 */
class PortTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.port',
		'app.country',
		'app.seller',
		'app.form_m',
		'app.loading_port',
		'app.discharge_port',
		'app.good',
		'app.trade',
		'app.customer',
		'app.document',
		'app.courier',
		'app.shipping',
		'app.shipping_line'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Port = ClassRegistry::init('Port');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Port);

		parent::tearDown();
	}

}
