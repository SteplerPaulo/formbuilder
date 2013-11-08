<?php 
/** 
 * View Class for JSON
 * 
 * @author Juan Basso 
 * @author Jonathan Dalrymple
 * @author kvz
 * @url http://blog.cakephp-brasil.org/2008/09/11/trabalhando-com-json-no-cakephp-12/ 
 * @licence MIT 
 */ 
class JsonView extends View { 
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

	// Adapted from http://www.php.net/manual/en/function.json-encode.php#82904. Author: Steve (30-Apr-2008 05:35)
	public function encode ($response) {
		if (function_exists('json_encode')) {
			// PHP 5.2+
			return $this->pretty_json(json_encode($response));
		}

		if (is_null($response)) {
			return 'null';
		}
		if ($response === false) {
			return 'false';
		}
		if ($response === true) {
			return 'true';
		}
		if (is_scalar($response)) {
			if (is_float($response)) {
				return floatval(str_replace(",", ".", strval($response)));
			}

			if (is_string($response)) {
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $response) . '"';
			} else {
				return $response;
			}
		}
		$isList = true;
		for ($i = 0, reset($response); $i < count($response); $i++, next($response)) {
			if (key($response) !== $i) {
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList) {
			foreach ($response as $v) {
				$result[] = $this->encode($v);
			}
			return '[' . join(',', $result) . ']';
		} else {
			foreach ($response as $k => $v) {
				$result[] = $this->encode($k) . ':' . $this->encode($v);
			}
			return '{' . join(',', $result) . '}';
		}
	}
	public function pretty_json($json) {
		$result      = '';
		$pos         = 0;
		$strLen      = strlen($json);
		$indentStr   = '  ';
		$newLine     = "\n";
		$prevChar    = '';
		$outOfQuotes = true;

		for ($i=0; $i<=$strLen; $i++) {

			// Grab the next character in the string.
			$char = substr($json, $i, 1);

			// Are we inside a quoted string?
			if ($char == '"' && $prevChar != '\\') {
				$outOfQuotes = !$outOfQuotes;
			
			// If this character is the end of an element, 
			// output a new line and indent the next line.
			} else if(($char == '}' || $char == ']') && $outOfQuotes) {
				$result .= $newLine;
				$pos --;
				for ($j=0; $j<$pos; $j++) {
					$result .= $indentStr;
				}
			}
			
			// Add the character to the result string.
			$result .= $char;

			// If the last character was the beginning of an element, 
			// output a new line and indent the next line.
			if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
				$result .= $newLine;
				if ($char == '{' || $char == '[') {
					$pos ++;
				}
				
				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}
			
			$prevChar = $char;
		}

		return $result;
	}
}