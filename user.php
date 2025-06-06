<?php
    session_start();
    trait greeting{
        function greet(){
            echo "Welcome to ATM\n";
        }
    }
    class user{
        use greeting;
        function __construct(){
            $this->greet();
        }
    }
    $userobj = new user();
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
</head>
<body>
    <form action="function.php" method="post">
        <input type="text" name="userName" placeholder="Enter the User Name" ><br><br>
        <input type="text" name="atmPin" placeholder="Enter ATM pin"><br><br>
        <input type="submit"><br><br>
    </form>
</body>
</html>
<?php 
    
?>