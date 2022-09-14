<?php
#Aquiring required information
include_once("config.php");

#$email = $_REQUEST['email'];
#$password = $_REQUEST['password'];

#establishing a connection


$conn =  mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("<p style=\"color: red;\">Could not connect to database!</p>");
    $newusername= $_GET['username'];
    $newpassword1= $_GET['password1'];
    $newpassword2=$_GET['password2'];
    
   if(isset($_POST['record'])){
    if(!empty(trim($_POST['password']))&& !empty(trim($_POST['username']))){

        $password = $_POST['password'];
        $username = $_POST['username'] ;

        $enc_password = password_hash($password, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO users (username, password) VALUES('$username',''$enc_password')");
        if($conn->affected_rows !=1){
            $record_error="Something went wrong";
        }else{$record_sucess = "Password hashed and stored sucessfully ";
            
    
        }

        
    }else{ // else i will display n error message.
        $record_error = "Both fields must have values";
        
    }
   }    
   