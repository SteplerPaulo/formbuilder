<?php
/* Vendor Test cases generated on: 2013-09-23 05:48:59 : 1379915339*/
App::import('Model', 'Vendor');

class VendorTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor', 'app.vendor_contact', 'app.vendor_credential', 'app.vendor_detail');

	function startTest() {
		$this->Vendor =& ClassRegistry::init('Vendor');
	}

	function endTest() {
		unset($this->Vendor);
		ClassRegistry::flush();
	}

}
