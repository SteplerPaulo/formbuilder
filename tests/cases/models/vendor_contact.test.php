<?php
/* VendorContact Test cases generated on: 2013-09-23 05:49:13 : 1379915353*/
App::import('Model', 'VendorContact');

class VendorContactTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor_contact', 'app.vendor', 'app.vendor_credential', 'app.vendor_detail');

	function startTest() {
		$this->VendorContact =& ClassRegistry::init('VendorContact');
	}

	function endTest() {
		unset($this->VendorContact);
		ClassRegistry::flush();
	}

}
