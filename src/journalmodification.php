<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}

if ($_SESSION['userrole'] == 1) {
    header("location:login.php"); 
    exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'applicationdomain';
$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Pull transaction number max
$gettrans = "SELECT MAX(transactionID) AS latestTransaction FROM transactions WHERE status <= 2";
$transresult = mysqli_query($link, $gettrans); //runs the qry
$currenttransID = mysqli_fetch_array($transresult);
$transactionID = $currenttransID['latestTransaction'];

$gettrans = "SELECT MAX(batchID) AS latestBatch FROM transactions WHERE status <= 2";
$batchresult = mysqli_query($link, $gettrans); //runs the qry
$currentbatchID = mysqli_fetch_array($batchresult);
$batchID = $currentbatchID['latestBatch'] + 1;


if(isset($_POST['SubmitBatch'])) {

    if (!isset($_SESSION['transcount'])) {
            $_SESSION['transcount'] = 1;
        }
        $transactionID = $transactionID + $_SESSION['transcount'];
    
        $account = $_POST['Account'];		
        $submitter = $_SESSION['id'];
        $description = $_POST['Desc'];
        $debit = $_POST['debit'];	
        $credit = $_POST['credit'];	
    
        $sqlupd = "INSERT INTO `transactions` (`transactionID`, `AccountID`, `SubmitterID`, `debit`, `credit`, `status`, 'batchID') 
        VALUES ('$transactionID', '$account', '$submitter', '$debit', '$credit', '0', '$batchID')";
    
        $edit = mysqli_query($link, $sqlupd); //runs the qry
        if($edit) //entered if acct created successfully
        {
            header("location:addadjusting.php"); //Reload page
            exit;
        }
        else
        {
            echo "Could Not Add Line, SQL Returned Error";
        }
}

if(isset($_POST['NextTransaction'])) {
	$_SESSION['transcount'] = $_SESSION['transcount'] + 1;
}