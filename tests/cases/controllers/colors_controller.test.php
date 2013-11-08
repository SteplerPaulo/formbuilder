<?php
/* Colors Test cases generated on: 2013-10-01 16:28:17 : 1380616097*/
App::import('Controller', 'Colors');

class TestColorsController extends ColorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ColorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.color');

	function startTest() {
		$this->Colors =& new TestColorsController();
		$this->Colors->constructClasses();
	}

	function endTest() {
		unset($this->Colors);
		ClassRegistry::flush();
	}

}
