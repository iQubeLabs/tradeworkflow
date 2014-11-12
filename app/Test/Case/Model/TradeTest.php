<?php
App::uses('Trade', 'Model');

/**
 * Trade Test Case
 *
 */
class TradeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.trade',
		'app.customer',
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
		$this->Trade = ClassRegistry::init('Trade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Trade);

		parent::tearDown();
	}

}
