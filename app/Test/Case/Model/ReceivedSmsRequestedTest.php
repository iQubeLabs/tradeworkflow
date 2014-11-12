<?php
App::uses('ReceivedSmsRequested', 'Model');

/**
 * ReceivedSmsRequested Test Case
 *
 */
class ReceivedSmsRequestedTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.received_sms_requested'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ReceivedSmsRequested = ClassRegistry::init('ReceivedSmsRequested');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReceivedSmsRequested);

		parent::tearDown();
	}

}
