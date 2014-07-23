<?php
namespace Etalx\Common;

class Thunderhorse {
	
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