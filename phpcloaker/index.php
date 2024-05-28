<?php

require_once("cloaker.class.php");
//const CLOAK_MODE = "Quick";
const CLOAK_MODE = "Secure";


if (cloaker::IsGoogle(CLOAK_MODE)) {
    header("Location: https://google.com/", true, 301);
        return;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8082');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $ch );
	curl_close( $ch );

	/* --- added --- */
	$links = "";
	for ($i=0; $i<10; $i++) {
		    $links .= '<a href="/' . rand(10,99) . '/' . rand(10000,999999) . '.html">' . rand(10,1000) . '</a><br />' . "\n";
	}

	$response = str_replace("[[links]]", $links, $response);
	/* --- added end --- */
//	echo "printing links variable";
//	echo $links;

        header('Content-length: ' . strlen($response));

        echo $response;

?>
