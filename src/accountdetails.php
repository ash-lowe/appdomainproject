<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'applicationdomain';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
if ($stmt = $con->prepare('SELECT faccount, fdescription, normalside, fcategory, fsubcategory, debit, credit, fdatecreated, userID, comment, active FROM faccount WHERE faccountID = ?')){
	// In this case we can use the account ID to get the account info.
	$stmt->bind_param('i', $_GET['u']);
	$stmt->execute();
	$stmt->bind_result($faccount, $fdescription, $normalside, $fcategory, $fsubcategory, $debit, $credit, $fdatecreated, $userID, $comment, $active);
	$stmt->fetch();
	$stmt->close();
}

if ($_SESSION['userrole'] == '1'):
	$role = "Administrator";
elseif ($_SESSION['userrole'] == '2'):
	$role = "Manager";
elseif ($_SESSION['userrole'] == '3'):
	$role = "User";
else:
	$role = "Undefined";
endif;

if ($active == 1)
	$active = "Yes";
else
	$active = "No";

if ($normalside == 0)
	$normalside = "Debit";
else
	$normalside	 = "Credit";

switch ($fcategory){
    case 1:
	    $fcategory = "Asset";
        break;
    case 2: 
        $fcategory = "Liability";
        break;
    case 3:
        $fcategory = "Equity";
        break;
    case 4:
        $fcategory = "Revenue";
        break;
    case 5:
        $fcategory = "Expense";
        break;
    }