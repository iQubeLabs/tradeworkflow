<?php
App::uses('Paar', 'Model');

/**
 * Paar Test Case
 *
 */
class PaarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.paar',
		'app.account'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Paar = ClassRegistry::init('Paar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Paar);

		parent::tearDown();
	}

}
