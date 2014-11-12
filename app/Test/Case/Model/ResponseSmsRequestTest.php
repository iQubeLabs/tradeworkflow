<?php
App::uses('ResponseSmsRequest', 'Model');

/**
 * ResponseSmsRequest Test Case
 *
 */
class ResponseSmsRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.response_sms_request',
		'app.sms_request'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ResponseSmsRequest = ClassRegistry::init('ResponseSmsRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ResponseSmsRequest);

		parent::tearDown();
	}

}
