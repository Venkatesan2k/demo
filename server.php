<?php 
   include 'dbConnection.php';
   class server extends db{
        function validate($_Adata){
            $_Squery = "SELECT 
                            *
                        FROM 
                            account_details
                        WHERE 
                            user_name=:username;";
            $_Ostmt = $this->dbConnection()->prepare($_Squery);
            $_Ostmt->bindParam(":username",$_Adata['userName']);
            $_Ostmt->execute();
            $_resdata = $_Ostmt->fetch(PDO::FETCH_ASSOC);
            return $_resdata;
        }
        function checkBalance($_userId){
            $_Squery = "SELECT
                            balance
                        FROM 
                            account_details
                        WHERE user_id=:userId;";
            $_Ostmt = $this->dbConnection()->prepare($_Squery);
            $_Ostmt->bindParam(":userId",$_userId);
            $_Ostmt->execute();
            $_resdata = $_Ostmt->fetch(PDO::FETCH_ASSOC);
            return $_resdata;
        }
        function debit($_Adata){
            $_Squery = "UPDATE
                            account_details
                        SET 
                            balance = balance - :debitamt
                        WHERE user_id=:userId;";
            $_Ostmt = $this->dbConnection()->prepare($_Squery);
            $_Ostmt->bindParam(":debitamt",$_Adata['amount']);
            $_Ostmt->bindParam(":userId",$_Adata['userId']);
            $_Ostmt->execute();
            // $_resdata = $_Ostmt->fetch(PDO::FETCH_ASSOC);
            // return $_resdata;
        }
        function credit($_Adata){
            $_Squery = "UPDATE
                            account_details
                        SET 
                            balance = balance + :debitamt
                        WHERE user_id=:userId;";
            $_Ostmt = $this->dbConnection()->prepare($_Squery);
            $_Ostmt->bindParam(":debitamt",$_Adata['amount']);
            $_Ostmt->bindParam(":userId",$_Adata['userId']);
            $_Ostmt->execute();
            // $_resdata = $_Ostmt->fetch(PDO::FETCH_ASSOC);
            // return $_resdata;
        }
   }
   $serverobj = new server();
    if(isset($_POST)){
        $_Saction = $_POST['action'];

        if($_Saction=="validate"){
            $_Adata = json_decode($_POST['data'],true);
            $_Aresdata = $serverobj->validate($_Adata);
            if($_Aresdata){
                print_r(json_encode($_Aresdata));
            }
            else{
                print_r(json_encode("0"));
            }
        }
        if($_Saction=="withdraw"){
            $_Adata = json_decode($_POST['data'],true);
            $serverobj->debit($_Adata);
        }
        if($_Saction=="deposit"){
            $_Adata = json_decode($_POST['data'],true);
            $serverobj->credit($_Adata);
        }
        if($_Saction=="checkBalance"){
            $_Adata = json_decode($_POST['data'],true);
            print_r(json_encode($serverobj->checkBalance($_Adata['userId']),true));
        }
    }

?>