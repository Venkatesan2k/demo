<?php
    include 'dbConnection.php';
    $data = fopen("accountdetails.csv","r");
    $_Adata = array();
    while($dataa = fgetcsv($data)){
        $_Adata[] = $dataa;
    }
    // print_r($_Adata);
    foreach($_Adata as $ind=>$val){
            $_Squery = "INSERT INTO
                            account_details(user_name,rk_account_type,account_number,branch,IFSC_code,balance,atm_pin)
                        VALUES
                            (:userName,:accountType,:accountNumber,:branch,:ifscCode,:balance,:atmPin);";
            $_Ostmt = $dbobj->dbConnection()->prepare($_Squery);
            $_Ostmt->bindParam(":userName",$val[0]);
            $_Ostmt->bindParam(":accountType",$val[1]);
            $_Ostmt->bindParam(":accountNumber",$val[2]);
            $_Ostmt->bindParam(":branch",$val[3]);
            $_Ostmt->bindParam(":ifscCode",$val[4]);
            $_Ostmt->bindParam(":balance",$val[5]);
            $_Ostmt->bindParam(":atmPin",$val[6]);
            $_Ostmt->execute();
    }
    
?>