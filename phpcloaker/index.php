<?php
// Include the log_visit function from the separate file
include 'log_visit.php';
include 'domains.php';

require_once("cloaker.class.php");
//const CLOAK_MODE = "Quick";
const CLOAK_MODE = "Secure";
define("AMOUNT_ENTRIES", 1000);
define("AMOUNT_INTERLINK", 50);
log_visit();

//$domains = array(
  //         'adsunchained.com',
    //    'getunchainedleads.com',
      //  'tryunchainedleads.com',
        //'unchainedads.com',
        //'unchainedmarketingleads.com',
        //'unchainedperformancemarketing.com',
        //'useunchainedleads.com',
        //'gounchainedleads.com',
        //'getunchainedleads.com',
       // 'unchained1.xyz',
       // 'unchained2.xyz',
       // 'unchained3.xyz',
        //'unchained4.xyz',
        //'unchained5.xyz',
        //'unchained6.xyz',
        //'unchained7.xyz',
        //'unchained8.xyz',
        //'unchained9.xyz',
        //'unchained10.xyz'

//);




if (!cloaker::IsGoogle(CLOAK_MODE)) {
    header("Location: https://unchain.link", true, 301);
        return;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8082');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec( $ch );
        curl_close( $ch );


        //add internal links
        $links = "";

        // New interlinking embed section
        for ($i = 0; $i < AMOUNT_INTERLINK; $i++) {
                $index = rand(0, count($domains) - 1);
                $target = $domains[$index];

        $links .= sprintf(
                '<embed src="https://%s/eg/%s.html" type="application/xml" autostart="true" loop="true" width="20" height="20" />' . "\n",
                $target, RandNum()
                );
        $links .= sprintf(
                '<object data="https://%s/og/%s.html" width="40" height="30" type="text/html">%s</object>' . "\n",
                $target, RandNum(), RandNum()
                );
        $links .= sprintf(
                '<iframe src="https://%s/ig/%d.html"></iframe>' . "\n",
                $target, RandNum()
                );
        }



        for ($i=0; $i< AMOUNT_ENTRIES; $i++) {
        $links .= '<a href="/int/' . rand(10,99) . '/' . rand(10000,999999999) . '.html">' . rand(10,99999) . '</a><br />' . "\n";
}

        //add external interlinking



        for ($i=0; $i<9; $i++) {
        $links .= '<a href="https://' . $domains[rand(0,count($domains)-1)] . '/ext/' . rand(10,99) . '/' . rand(10000,999999999) . '.html">' . rand(10,99999) . '</a><br />' . "\n";
}



        $response = str_replace("[[links]]", $links, $response);
        /* --- added end --- */
//      echo "printing links variable";
//      echo $links;

        header('Content-length: ' . strlen($response));

        echo $response;

function RandNum(){
    return 100000 + rand(0,89999999);
}

?>
