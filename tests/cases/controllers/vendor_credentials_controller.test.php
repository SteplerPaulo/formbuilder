<?php
/* VendorCredentials Test cases generated on: 2013-09-23 05:50:33 : 1379915433*/
App::import('Controller', 'VendorCredentials');

class TestVendorCredentialsController extends VendorCredentialsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VendorCredentialsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor_credential', 'app.vendor', 'app.vendor_contact', 'app.vendor_detail');

	function startTest() {
		$this->VendorCredentials =& new TestVendorCredentialsController();
		$this->VendorCredentials->constructClasses();
	}

	function endTest() {
		unset($this->VendorCredentials);
		ClassRegistry::flush();
	}

}
