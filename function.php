<?php
    session_start();
    include 'curl.php';
    class funct extends curl{
        function validate($_SuserName,$_IatmPin){
            $_Afdata = array(
                "userName" => $_SuserName,
                "atmPin" => $_IatmPin,
            );
            $_Adata = array();
            $_Adata['data'] = json_encode($_Afdata);
            $_Adata['action'] = "validate";
            $response = $this->curloperation($_Adata);
            // print_r($response);die;
            if(!$response){
                echo "User Name or ATM pin not match";exit;
            }
            else{
                return $response;
            }
        }
         function getAmountfordebit(){
    ?> 
            <form action="" method="post">
                <br>
                <input type="text" placeholder="Enter the amount" name="debit"> <br><br>
                <input type="submit" value="proceed">
            </form>
    <?php
        }
         function getAmountforcredit(){
    ?> 
            <form action="" method="post">
                <br>
                <input type="text" placeholder="Enter the amount" name="credit"> <br><br>
                <input type="submit" value="proceed">
            </form>
    <?php
        }
        function debit($_Iamount,$_IuserId){
             $_Afdata = array(
                "amount" => $_Iamount,
                "userId" => $_IuserId
            );
            $_Adata = array();
            $_Adata['data'] = json_encode($_Afdata);
            $_Adata['action'] = "withdraw";
            return $this->curloperation($_Adata);
        }
        function credit($_Iamount,$_IuserId){
             $_Afdata = array(
                "amount" => $_Iamount,
                "userId" => $_IuserId
            );
            $_Adata = array();
            $_Adata['data'] = json_encode($_Afdata);
            $_Adata['action'] = "deposit";
            return $this->curloperation($_Adata);
        }
        function checkBalance($_IuserId){
            $_Adata = array();
            $_Afdata = array(
                "userId"=>$_IuserId
            );
            $_Adata['data'] = json_encode($_Afdata);
            $_Adata['action'] = "checkBalance";
            $result = $this->curloperation($_Adata);
            print_r($result['balance']);
        }
    }
    $functionobj = new funct();

    if(isset($_POST['userName']) && isset($_POST['atmPin'])){
        $_SuserName = $_POST['userName'];
        $_IatmPin = $_POST['atmPin'];
        $result = $functionobj->validate($_SuserName,$_IatmPin);
        if($result){ 
            // echo $result['user_id'];die;
            $_SESSION['userId'] = $result['user_id'];
            ?>
            <form action="" method="post">
                <input type="radio" id= "Debit" name="action" value="debit">
                <label for="Debit">Withdraw</label><br>
                <input type="radio" id="Credit" name="action" value="credit">
                <label for="Credit">Deposit</label><br>
                <input type="radio" id="chkbal" name="action" value="chbal">
                <label for="chkbal">Check Balance</label><br><br>
                <input type="submit">
            </form>
    <?php
        }
    }


    if(isset($_POST['action']) ){
        $_Saction = $_POST['action'];
        if($_Saction=="debit"){
            $functionobj->getAmountfordebit();
        }
        if($_Saction=="credit"){
            $functionobj->getAmountforcredit();
        }
        if($_Saction=="chbal"){
            // echo $_SESSION['userId'];die;
            $functionobj->checkBalance($_SESSION['userId']);
        }
    }
    if(isset($_POST['debit'])){
        echo  $functionobj->debit($_POST['debit'],$_SESSION['userId']);
    }
    if(isset($_POST['credit'])){
        echo  $functionobj->credit($_POST['credit'],$_SESSION['userId']);
    }
?>