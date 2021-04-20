<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

if ($_SESSION['userrole'] != 1) {
    header("location:home.php"); 
    exit;
}


include "scripts/email.php";
include "scripts/userscripts.php";

//Set a page variable based on if page was entered via profile or users page and parses for a person to be editing. Forces to default for non admins
if(isset($_GET['u'])&& $_SESSION['userrole'] == 1) {
	$editu = $_GET['u'];
} else {
	$editu = $_SESSION['id'];
}

if(isset($_GET['r'])&& $_SESSION['userrole'] == 1) {
	$return = $_GET['r'];
} else {
	$return = 2;
}



$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'accountingprojectlogin';
$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
//Primes the query to pull user data based on the user being edited
$sql = "SELECT * FROM accounts WHERE id='$editu'";

$qry = mysqli_query($link, $sql);
$data = mysqli_fetch_array($qry);
$newDate = date("Y-m-d", strtotime($data['DOB']));

if(isset($_POST['update'])) {
	$newEmail = $_POST['email'];
	$newFname = $_POST['Fname'];
	$newLname = $_POST['Lname'];
	$newDOB = $_POST['dob'];

	//primes, then fires, the update query
	$sqlupd = "UPDATE accounts SET Email = '$newEmail', Fname = '$newFname', Lname = '$newLname', DOB = '$newDOB' WHERE id='$editu'";
	$edit = mysqli_query($link, $sqlupd);
	if($edit)
    {
        header("location:edituser.php?r=$return&u=$editu"); 
        exit;
    }
    else
    {
        echo mysqli_error();
	}   	
}
//Separate Script To Fire For Admin Updates
if(isset($_POST['updateADMN'])) {

	$primeMSG = false;
	$newRole = $_POST['role'];
	$newStatus = $_POST['status'];
	if($data['active']!=1) {
		$primeMSG = true;
	}
	$sqlupd = "UPDATE accounts SET userrole = '$newRole', active = '$newStatus' WHERE id='$editu'";
	$edit = mysqli_query($link, $sqlupd);
	if($edit)
    {
		if ($primeMSG == true && $newStatus == 1) {
			$to_email = $data['Email'];
			$body = 'An Administrator Has Activated Your Accounting Pro Account, Sign In Today!';
			$subject = 'Accounting Pro Account Activated';
			sendEmailFromServer($to_email, $subject, $body);
		}
		header("location:edituser.php?r=$return&u=$editu"); 	
    }
    else
    {
        echo mysqli_error();
	} 
} 
//script for updating suspension windows
if(isset($_POST['updateSuspension'])) {
	$susStart = $_POST['start'];
	$susEnd = $_POST['end'];
	setSuspensionDates($editu, $susStart, $susEnd);
	header("location:edituser.php?r=$return&u=$editu"); 
} 