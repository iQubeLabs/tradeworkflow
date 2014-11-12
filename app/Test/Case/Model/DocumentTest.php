<?php
App::uses('Document', 'Model');

/**
 * Document Test Case
 *
 */
class DocumentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.document',
		'app.courier',
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
		$this->Document = ClassRegistry::init('Document');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Document);

		parent::tearDown();
	}

}
