<?php
App::uses('ReceivedWebRequest', 'Model');

/**
 * ReceivedWebRequest Test Case
 *
 */
class ReceivedWebRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.received_web_request',
		'app.web_request'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ReceivedWebRequest = ClassRegistry::init('ReceivedWebRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReceivedWebRequest);

		parent::tearDown();
	}

}
