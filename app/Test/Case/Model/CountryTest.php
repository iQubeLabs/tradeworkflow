<?php
App::uses('Country', 'Model');

/**
 * Country Test Case
 *
 */
class CountryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.country',
		'app.port',
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
		$this->Country = ClassRegistry::init('Country');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Country);

		parent::tearDown();
	}

}
