<?php

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $conn = new mysqli('localhost','root','','spl');

    if($conn -> connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("insert into users(username,email,password) values(?,?,?)");
        $stmt ->bind_param("sss",$username, $email, $password);
        $stmt -> execute();
        echo "Logged in successfully!";
        $stmt -> close();
        $conn -> close();
    }


?>