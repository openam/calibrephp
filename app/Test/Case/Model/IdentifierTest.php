<?php
App::uses('Identifier', 'Model');

/**
 * Identifier Test Case
 *
 */
class IdentifierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.identifier'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Identifier = ClassRegistry::init('Identifier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Identifier);

		parent::tearDown();
	}

}
