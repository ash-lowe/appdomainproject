<?php

include 'scripts/user-defaults.php';

$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'appdomain';
$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$email = $_POST['email'];

$sql = "SELECT SecurityQ1, SecurityQ2, SecurityA1, SecurityA2, id  FROM accounts WHERE Email='$email'";
//Gets current user data
$qry = mysqli_query($link, $sql);
$data = mysqli_fetch_array($qry);

if(isset($_POST['Change'])) {
	$newpass = $_POST['newPass'];
	passwordRequirements($newpass);
	$hashed = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
	$a1 = $_POST['answer1'];
	$a2 = $_POST['answer2'];

	//Checks to see if questions match answers
	if($data['SecurityA1'] != $a1 || $data['SecurityA2'] != $a2) {
		echo 'incorrect answers for security questions.';
		exit;
    }
	//check if password was already used
	$id = $data['id'];
	$sql2 = "SELECT * FROM pastpassword WHERE ID = '$id'";
		if($result = mysqli_query($link, $sql2)){
			if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result)){
						if (password_verify($newpass, $row['Password'])) {
							echo 'You have already used that password, please choose another.';
							exit;
					}}
				mysqli_free_result($result);
	}}
	$sqlupd = "UPDATE accounts SET password = '$hashed' WHERE Email='$email'";
	$edit = mysqli_query($link, $sqlupd);
	if($edit) {
		setPasswordExpire($data['id']);
        storePassword($data['id']);
        header("index.html"); 
        exit;
    }
    else
    {
        echo mysqli_error();
	} 
} 

