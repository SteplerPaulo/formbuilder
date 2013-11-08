<?php
/* Vendors Test cases generated on: 2013-09-23 05:51:45 : 1379915505*/
App::import('Controller', 'Vendors');

class TestVendorsController extends VendorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VendorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor', 'app.vendor_contact', 'app.vendor_credential', 'app.vendor_detail');

	function startTest() {
		$this->Vendors =& new TestVendorsController();
		$this->Vendors->constructClasses();
	}

	function endTest() {
		unset($this->Vendors);
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
