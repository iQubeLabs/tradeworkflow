<?php
App::uses('Courier', 'Model');

/**
 * Courier Test Case
 *
 */
class CourierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.courier',
		'app.document',
		'app.trade',
		'app.customer',
		'app.form_m',
		'app.seller',
		'app.country',
		'app.port',
		'app.loading_port',
		'app.discharge_port',
		'app.good',
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
		$this->Courier = ClassRegistry::init('Courier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Courier);

		parent::tearDown();
	}

}
