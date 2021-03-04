<?php
$username = $_POST['username'];
$password = $_POST['password'];

//Database connection
$conn = new mysqli('localhost', 'root', '','appdomainproject');
if($conn -> connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $stml = $conn->prepare("insert into registration(username, password) values(?,?)");
    $stml->bind_param("ss",$username, $password);
    $stml->execute();
    echo "registration Sucessfully...";
    $stml->close();
    $conn->close();
}

?>