<?php
/**
 * View Class for XML
 *
 * @author Jonathan Dalrymple
 * @author kvz
 */
class XmlView extends View {
	public $BluntXml;
	public function render ($action = null, $layout = null, $file = null) {
		if (!array_key_exists('response', $this->viewVars)) {
		    trigger_error(
				'viewVar "response" should have been set by Rest component already',
				E_USER_ERROR
			);
			return false;
		}

		return $this->encode($this->viewVars['response']);
	}

	public function encode ($response) {
		require_once dirname(dirname(__FILE__)) . '/libs/BluntXml.php';
		$this->BluntXml = new BluntXml();
		return $this->BluntXml->encode(
			$response,
			Inflector::tableize($this->params['controller']) . '_response'
		);
	}
}