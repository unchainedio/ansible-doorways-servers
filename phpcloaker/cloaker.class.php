<?php

class Cloaker
{
    const IPS_FILE ="googlebotIps.txt";

    public static function IsGoogle($mode = "Secure") {
	    if (!stripos($_SERVER["HTTP_USER_AGENT"], "Googlebot")) {
    	    return false;
    	}
    
        if ($mode == "Secure") {
            return self::isGoogleIP(self::IPS_FILE);
        } else {
            return self::isGoogleIPQuick();  
        }
    }


    /***  private ***/
    /************************* */
    private static function isGoogleIP() {
        $ips = file(self::IPS_FILE);

        foreach ($ips as $ip) {
            if ($_SERVER['REMOTE_ADDR'] == trim($ip)) {
                return true;
            }
        }
	    return false;
    }


    private static function isGoogleIPQuick() {
        if (stripos($_SERVER['REMOTE_ADDR'], "66.249.") === 0 ) {
            return true;
        }

	    return false;
    }
}

?>
