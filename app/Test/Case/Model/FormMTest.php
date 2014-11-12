<?php
App::uses('FormM', 'Model');

/**
 * FormM Test Case
 *
 */
class FormMTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.form_m',
		'app.seller',
		'app.country',
		'app.port',
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
		$this->FormM = ClassRegistry::init('FormM');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FormM);

		parent::tearDown();
	}

}
