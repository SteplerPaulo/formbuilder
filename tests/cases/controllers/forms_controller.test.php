<?php
/* Forms Test cases generated on: 2013-11-05 16:16:29 : 1383639389*/
App::import('Controller', 'Forms');

class TestFormsController extends FormsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FormsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.form', 'app.form_type', 'app.form_domain', 'app.question', 'app.domain', 'app.question_option');

	function startTest() {
		$this->Forms =& new TestFormsController();
		$this->Forms->constructClasses();
	}

	function endTest() {
		unset($this->Forms);
		ClassRegistry::flush();
	}

}
