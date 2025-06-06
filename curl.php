<?php
    class curl{
        function curloperation($_Adata){
                $_Sapikey  = "api123"; 
                // CURL PROCESS
                $_Ocurl = curl_init();
                
                curl_setopt_array($_Ocurl,array(
                    CURLOPT_URL => "http://localhost/training/curl/server.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_POSTFIELDS => $_Adata,
                    CURLOPT_HTTPHEADER => array(
                        "API-KEY:$_Sapikey"
                    )
                ));
                $_response = curl_exec($_Ocurl);
                curl_close($_Ocurl);
                return json_decode($_response,true);
            }
    }
?>