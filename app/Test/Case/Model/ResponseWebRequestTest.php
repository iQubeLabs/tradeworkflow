<?php
App::uses('ResponseWebRequest', 'Model');

/**
 * ResponseWebRequest Test Case
 *
 */
class ResponseWebRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.response_web_request',
		'app.web_request'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ResponseWebRequest = ClassRegistry::init('ResponseWebRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ResponseWebRequest);

		parent::tearDown();
	}

}
