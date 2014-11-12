<?php
App::uses('Good', 'Model');

/**
 * Good Test Case
 *
 */
class GoodTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.good',
		'app.form_m',
		'app.seller',
		'app.country',
		'app.port',
		'app.loading_port',
		'app.discharge_port',
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
		$this->Good = ClassRegistry::init('Good');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Good);

		parent::tearDown();
	}

}
