<?php
App::uses('Shipping', 'Model');

/**
 * Shipping Test Case
 *
 */
class ShippingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shipping',
		'app.loading_port',
		'app.discharge_port',
		'app.trade',
		'app.customer',
		'app.form_m',
		'app.seller',
		'app.country',
		'app.port',
		'app.good',
		'app.document',
		'app.courier',
		'app.shipping_line'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Shipping = ClassRegistry::init('Shipping');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shipping);

		parent::tearDown();
	}

}
