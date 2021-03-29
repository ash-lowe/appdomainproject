<?php

include 'scripts/user-defaults.php';

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'applicationdomain';
$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$email = $_POST['email'];

$sql = "SELECT QUESTION1, QUESTION2, QUESTION3 ANSWER1, ANSWER2, ANSWER3 id  FROM useraccount WHERE Email='$email'";
//Gets current user data
$qry = mysqli_query($link, $sql);
$data = mysqli_fetch_array($qry);

if(isset($_POST['Change'])) {
	$newpass = $_POST['newPass'];
	passwordRequirements($newpass);
	$hashed = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
	$a1 = $_POST['ANSWER1'];
	$a2 = $_POST['ANSWER2'];
	$a3 = $_POST['ANSWER3'];


	//Checks to see if questions match answers
	if($data['ANSWER1'] != $a1 || $data['ANSWER2'] != $a2 || $data['ANSWER3'] != $a3) {
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
	$sqlupd = "UPDATE useraccount SET password = '$hashed' WHERE Email='$email'";
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