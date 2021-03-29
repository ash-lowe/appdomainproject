<?php
$fname = $_POST['First Name'];
$lname = $_POST['Last Name'];
$email = $_POST['Email Address'];
$month = $_POST['Month'];
$day = $_POST['Day'];
$year = $_POST['Year'];

//Database connection
$conn = new mysqli('localhost', 'root', '','appdomainproject');
if($conn -> connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $stml = $conn->prepare("insert into registration(fname, lname,email,month,day,year) values(?,?,?,?,?,?)");
    $stml->bind_param("ssssss",$fname, $lname,$email,$month,$day,$year);
    $stml->execute();
    echo "registration Sucessfully...";
    $stml->close();
    $conn->close();
}

?>