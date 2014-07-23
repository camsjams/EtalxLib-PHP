<?php

class Thunderhorse {
	
	public $config = null;
	
	const SITE_CONFIG_DEFAULT = 'default';
	
	public function __construct($env = ""){
		// config mapping
		$this->_getConfig($env);
	}
	
	 /**
     * Prints variable or objects in nicely formatted <pre> tag
     * Thunderhorse::debug()
     * @access static
     * @param object, string, string
     * @return void
     */    
    public static function debug($varToDump = "",  $label = "", $title = "Debugger"){
		echo "<div class=\"alert alert-warning\"><h3>$title: $label</h3><pre>";
        if($varToDump === ""){
        	echo "empty resource ";
            var_dump(NULL);
        }
        else{
            var_dump($varToDump);
        }
        echo "</pre></div>";
    }
	
	private function _getConfig($env = "") {
		$siteConfig = require_once($this->_getConfigPath());
		if(isset($siteConfig) && is_array($siteConfig) && $siteConfig[$env]) {
			$this->config = array_merge_recursive($siteConfig[static::SITE_CONFIG_DEFAULT], $siteConfig[$env]);
		}
	}
	
	private function _getConfigPath(){
		return __DIR__ . "/config.php";
	}
	
	public static function cleanString($string = '') {
		return preg_replace('/[^-a-zA-Z0-9_]/', '', $string);
	}
	
	public static function getParam($param = "", $default = ""){
        if(isset($_GET[$param])) {
        	return self::cleanString($_GET[$param]);
        } else {
            return $default;
        }        
    }
}
?>