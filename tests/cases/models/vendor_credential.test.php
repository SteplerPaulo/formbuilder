<?php
/* VendorCredential Test cases generated on: 2013-09-23 05:49:25 : 1379915365*/
App::import('Model', 'VendorCredential');

class VendorCredentialTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor_credential', 'app.vendor', 'app.vendor_contact', 'app.vendor_detail');

	function startTest() {
		$this->VendorCredential =& ClassRegistry::init('VendorCredential');
	}

	function endTest() {
		unset($this->VendorCredential);
		ClassRegistry::flush();
	}

}
