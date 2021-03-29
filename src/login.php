<?php
session_start();
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="applicationdomain";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();

if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT id, password, USERPOSITION, ACCOUNTACTIVE, STARTSUSPEND, ENDSUSPEND FROM useraccount WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();


    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $USERPOSITION, $status, $STARTSUSPEND, $ENDSUSPEND);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            
            $currentDateTime = new DateTime();
            $STARTSUSPEND = DateTime::createFromFormat("Y-m-d H:i:s", $STARTSUSPEND);
            $ENDSUSPEND = DateTime::createFromFormat("Y-m-d H:i:s", $ENDSUSPEND);
            
            //checks for inACCOUNTACTIVE users
            if ($status != 1) {
                echo 'This account is currently disabled, please contact your administrator.';
            } 
            elseif ($STARTSUSPEND < $currentDateTime && $currentDateTime < $ENDSUSPEND){
                echo ('This account is currently suspended please contact your admninistrator for help.  Account will be unsuspended on: ' . $ENDSUSPEND->format("Y-m-d H:i:s"));
            } else {
                if ($stmt = $con->prepare('UPDATE useraccount SET attempts = 0 WHERE username = ?')) {
                    $stmt->bind_param('s', $_POST['username']);
                    $stmt->execute();
                    $stmt->store_result();
                // Verification success! User has logged-in!
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                $_SESSION['USERPOSITION'] = $USERPOSITION;
                header('Location: ../dashboard.html');
            }}
        } else {
            if ($stmt2 = $con->prepare('UPDATE useraccount SET attempts = attempts + 1 WHERE username = ?')) {
                $stmt2->bind_param('s', $_POST['username']);
                $stmt2->execute();
            
                    if ($stmt3 = $con->prepare('SELECT attempts FROM useraccount WHERE username = ?')) {
                        $stmt3->bind_param('s', $_POST['username']);
                        $stmt3->execute();
                        $stmt3->store_result();
                        if ($stmt3->num_rows > 0) {
                            $stmt3->bind_result($attempts);
                            $stmt3->fetch();
                            
                            if ($attempts == 3) {
                                $stmt4 = $con->prepare('UPDATE useraccount SET ACCOUNTACTIVE = 0, attempts = 0 WHERE username = ?');
                                $stmt4->bind_param('s', $_POST['username']);
                                $stmt4->execute();
                                echo 'Too Many Wrong Attempts, Account Disabled.';
                                
                            }

                }}}

            echo 'Incorrect username or password! ';
        }
    } else {
        echo 'Incorrect username or password! ';
    }

	$stmt->close();
}
?>