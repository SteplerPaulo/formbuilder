<?php
/* VendorDetail Test cases generated on: 2013-09-23 05:49:33 : 1379915373*/
App::import('Model', 'VendorDetail');

class VendorDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor_detail', 'app.vendor', 'app.vendor_contact', 'app.vendor_credential');

	function startTest() {
		$this->VendorDetail =& ClassRegistry::init('VendorDetail');
	}

	function endTest() {
		unset($this->VendorDetail);
		ClassRegistry::flush();
	}

}
