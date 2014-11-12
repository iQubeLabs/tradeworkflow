<?php
App::uses('Customer', 'Model');

/**
 * Customer Test Case
 *
 */
class CustomerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer',
		'app.trade',
		'app.form_m',
		'app.seller',
		'app.country',
		'app.port',
		'app.loading_port',
		'app.discharge_port',
		'app.good',
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
		$this->Customer = ClassRegistry::init('Customer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customer);

		parent::tearDown();
	}

}
