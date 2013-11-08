<?php
/* VendorContacts Test cases generated on: 2013-09-23 05:50:24 : 1379915424*/
App::import('Controller', 'VendorContacts');

class TestVendorContactsController extends VendorContactsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VendorContactsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor_contact', 'app.vendor', 'app.vendor_credential', 'app.vendor_detail');

	function startTest() {
		$this->VendorContacts =& new TestVendorContactsController();
		$this->VendorContacts->constructClasses();
	}

	function endTest() {
		unset($this->VendorContacts);
		ClassRegistry::flush();
	}

}
