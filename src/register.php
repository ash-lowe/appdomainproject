<?php 
include 'userscripts.php';

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="applicationdomain";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();

    $generatedUser = generateUsernameByName($_POST['fName'], $_POST['lName']); 
    $unHashedPass= $_POST['password'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $DOB= $_POST['DOB'];
    $sq1= $_POST['question1'];
    $sa1=$_POST['ANSWER1'];
    $sq2= $_POST['question2'];
    $sa2=$_POST['ANSWER2'];
    $sq3= $_POST['question3'];
    $sa3=$_POST['ANSWER3'];
    $email= $_POST['Email'];

passwordRequirements($unHashedPass);

$password= password_hash($unHashedPass, PASSWORD_DEFAULT); 
    $query1 = "INSERT INTO useraccount (username, password, Fname, Lname, DOB, question1, ANSWER1, question2, ANSWER2, 
    question3 ANSWER3, Email)
    VALUES ('$generatedUser', '$password','$fName', '$lName','$DOB','$sq1','$sa1','$sq2','$sa2','$sq3','$sa3','$email')";
    $edit = mysqli_query($conn, $query1);
    if($edit)
    {
        if ($stmt = $conn->prepare('SELECT id FROM useraccount WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $generatedUser);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
        
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($qry);
                $stmt->fetch();
            }}
        setPasswordExpire($qry);
        storePassword($qry);
        echo 'Registered successfully, please wait for administrator approval ';
        exit;
    }
    else
    {
        echo mysqli_error();
    } 
?>