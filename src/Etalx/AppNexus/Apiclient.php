<?php
class Apiclient {
	
	private $_curl = null;
	
	private	$_apiUrl = "http://api-console.client-testing.adnxs.net";
	
	private	$_apiUsername = "YOUR_USERNAME_HERE";

	private	$_apiPassword = "YOUR_PASSWORD_HERE";

	private $_config = null;
	
	public function __construct() {
		global $thund;
		//Thunderhorse::debug('[AppnexusComponent] __construct');
		$this->_createCurlClient();
	}
	
	private function _createCurlClient() {
		//Thunderhorse::debug('[AppnexusComponent] _createCurlClient');
		$this->_curl = curl_init();
		curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->_curl, CURLOPT_COOKIEFILE, "cookies.txt");
		curl_setopt($this->_curl, CURLOPT_COOKIEJAR, "cookies.txt");
		// Auth W/ Connection Variables
		curl_setopt($this->_curl, CURLOPT_URL, $this->_apiUrl . "/auth?username=" . $this->_apiUsername . "&password=" . $this->_apiPassword);
		$response = curl_exec($this->_curl);
		if ($response === false) {
			//echo 'Curl error: ' . curl_error($this->_curl);
		} else {
			//echo 'Operation completed without any errors';
		}
		//Thunderhorse::debug($response);
	}

	private function _destroyCurlClient() {
		//Thunderhorse::debug('[AppnexusComponent] _destroyCurlClient');
		curl_close($this->_curl);
	}

	private function _doCurlPost($url = null, $fields = null) {
		//Thunderhorse::debug('[AppnexusComponent] _doCurlPost');
		if (isset($url) && isset($fields)) {
			$url = $this->_apiUrl . $url;
			//Thunderhorse::debug($url);
			//Thunderhorse::debug($fields);
			curl_setopt($this->_curl, CURLOPT_URL, $url);
			curl_setopt($this->_curl, CURLOPT_POST, true);
			curl_setopt($this->_curl, CURLOPT_POSTFIELDS, json_encode($fields));
			$response = curl_exec($this->_curl);
			if ($response === false) {
				//Thunderhorse::debug('Curl error: ' . curl_error($this->_curl));
			} else {
				//Thunderhorse::debug('Operation completed without any errors');
			}
			return $response;
		} else {
			//Thunderhorse::debug('[AppnexusComponent] _doCurlPost bad data');
		}
	}

	private function _doCurlPut($url = null, $fields = null) {
		//Thunderhorse::debug('[AppnexusComponent] _doCurlPut');
		if (isset($url) && isset($fields)) {
			$url = $this->_apiUrl . $url;
			//Thunderhorse::debug($url);
			//Thunderhorse::debug($fields);
			curl_setopt($this->_curl, CURLOPT_URL, $url);
			curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($this->_curl, CURLOPT_POSTFIELDS, json_encode($fields));
			$response = curl_exec($this->_curl);
			if ($response === false) {
				//Thunderhorse::debug('Curl error: ' . curl_error($this->_curl));
			} else {
				//Thunderhorse::debug('Operation completed without any errors');
			}
			return $response;
		} else {
			//Thunderhorse::debug('[AppnexusComponent] _doCurlPost bad data');
		}
	}

}
?>