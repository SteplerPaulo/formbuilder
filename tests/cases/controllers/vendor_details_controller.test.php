<?php
/* VendorDetails Test cases generated on: 2013-09-23 05:50:52 : 1379915452*/
App::import('Controller', 'VendorDetails');

class TestVendorDetailsController extends VendorDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VendorDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor_detail', 'app.vendor', 'app.vendor_contact', 'app.vendor_credential');

	function startTest() {
		$this->VendorDetails =& new TestVendorDetailsController();
		$this->VendorDetails->constructClasses();
	}

	function endTest() {
		unset($this->VendorDetails);
		ClassRegistry::flush();
	}

}
