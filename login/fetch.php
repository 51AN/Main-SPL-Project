<?php
    
    $username = '';
    $password = '';
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

    }

    $conn = new mysqli('localhost','root','','spl');

    if($conn -> connect_error)
    {
        die('Connection Failed : ' .$conn->connect_error);
    }
    else{
        $query = $conn->prepare("SELECT * FROM users WHERE `username` = ?");
        
        //if direct values are passed there is a chance of sql injection(dunno what that means...lol)
        //so use "?" then bind parameter
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        //1st checked username, then password
        if($result->num_rows > 0)
        {
            $data = $result->fetch_assoc();
            if($data['password'] === $password)
            {
                header('location: ../Homepage/index.html');
            }
            else
            {
                echo "Invalid password!";
            }
        }
        else
        {
            echo "Invalid email or password!";
        }
        $conn -> close();

    }

    ?>
