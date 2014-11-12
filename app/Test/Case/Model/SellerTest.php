<?php
App::uses('Seller', 'Model');

/**
 * Seller Test Case
 *
 */
class SellerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.seller',
		'app.country',
		'app.port',
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
		$this->Seller = ClassRegistry::init('Seller');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Seller);

		parent::tearDown();
	}

}
