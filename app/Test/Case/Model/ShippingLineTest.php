<?php
App::uses('ShippingLine', 'Model');

/**
 * ShippingLine Test Case
 *
 */
class ShippingLineTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.shipping_line',
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
		'app.courier'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShippingLine = ClassRegistry::init('ShippingLine');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShippingLine);

		parent::tearDown();
	}

}
