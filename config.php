<?php
    $servername = "";
    $username = "";
    $password = "";
    $dbname = ""; 

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn)
    {
        echo "Database connected!";
    }
    else
    {
        die("Cannot connect database".mysqli_connect_error());
    }
?>