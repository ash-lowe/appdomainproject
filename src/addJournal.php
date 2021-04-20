<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

include 'scripts/user-defaults.php'; 

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'applicationdomain';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($_SESSION['userrole'] != 1) {
    header("location:home.php"); // Non-Admins will go back to the homepage
    exit;
}

if(isset($_POST['Create'])) {
    $AcctName = $_POST['Name'];
    $Category = $_POST['Category'];
    $subCategory = $_POST['Subcategory'];
    $Comment = $_POST['Comment'];
    $Desc = $_POST['Description'];
    $startBal = $_POST['StartingBalance'];
    $createdBy = $_SESSION['id'];

    //find number of rows in current category, increments, and *10 it to get the acct number portion
    $query = "SELECT * FROM faccount WHERE fcategory = $Category"; 
    $result = mysqli_query($link, $query);  
    if ($result) 
    { 
        $row = mysqli_num_rows($result);
        $row ++;
        $row = $row*10;
    }
    $acctID = $Category . $row;
    if ($Category == 1 || $Category == 5) {
        $normalSide = 0;
    } else {
        $normalSide = 1;
    }

	$sqlupd = "INSERT INTO `faccount` (`faccountID`, `faccount`, `fdescription`, `normalside`, `fcategory`, `fsubcategory`, `finitialbalance`, `debit`, `credit`, `fbalance`, `userID`, `comment`, `active`) 
    VALUES ('$acctID', '$AcctName', '$Desc', '$normalSide', '$Category', '$subCategory', $startBal, 0.00, 0.00, '$startBal', '$createdBy', '$Comment', '1')";

    $edit = mysqli_query($link, $sqlupd); 
    if($edit) 
    {
        header("location:accounts.php"); 
        exit;
    }
    else
    {
        echo "Could Not Add Account, SQL Returned Error";
    }
}
 
?>