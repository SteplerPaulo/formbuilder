<?php
/* OptionTypes Test cases generated on: 2013-11-08 10:35:06 : 1383878106*/
App::import('Controller', 'OptionTypes');

class TestOptionTypesController extends OptionTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class OptionTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.option_type', 'app.question', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question_option', 'app.option');

	function startTest() {
		$this->OptionTypes =& new TestOptionTypesController();
		$this->OptionTypes->constructClasses();
	}

	function endTest() {
		unset($this->OptionTypes);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
