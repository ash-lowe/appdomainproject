<?php

function connectDB()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'applicationdomain';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    return $con;
}


//Password expiration logic
function setPasswordExpire($id)
{
    $con = connectDB();
    if ($stmt = $con->prepare('SELECT * FROM USERACCOUNT WHERE ID = ?')) {
    	$stmt->bind_param('i', $id);
	    $stmt->execute();
	    $stmt->store_result();
    	if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('UPDATE USERACCOUNT SET PasswordExpire = DATE_ADD(NOW(), INTERVAL 6 MONTH) WHERE ID = ?')) {
                $stmt->bind_param('i', $id);
                $stmt->execute();

                echo ('Account password expiration date has been updated! ');
            }
            else{
                echo 'Could not prepare statement. ';
            }
        } 
        else {
            echo ("Account not connected to entered ID. ");
        }
    }

    $con->close();
}

function generateUsernameByID($id)
{
    $con = connectDB();
    if ($stmt = $con->prepare('SELECT Fname, Lname, SIGNUPTIME FROM USERACCOUNT WHERE ID = ?')) {
    	$stmt->bind_param('i', $id);
	    $stmt->execute();
        $stmt->store_result();
    	if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('SELECT Fname, Lname, SIGNUPTIME FROM USERACCOUNT WHERE ID = ?')) {
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->bind_result($Fname, $Lname, $SIGNUPTIME);
                $stmt->fetch();
                $stmt->close();
                $username = substr($Fname, 0, 1);
                $username .= $Lname;
                $username .= substr($SIGNUPTIME, 5, 2);
                $username .= substr($SIGNUPTIME, 2, 2);

                if($stmt = $con->prepare('UPDATE USERACCOUNT SET username = ? WHERE ID = ?')) {
                    $stmt->bind_param("si", $username, $id);
                    $stmt->execute();

                    echo ("Username has been updated: " . $username);
                }
                else{
                    echo ('Issue creating statement to update username. ');
                }
            }
            else{
                echo ('Issue creating statement about pulling account value. ');
            }
        } 
        else {
            echo ("Account not connected to entered ID. ");
        } 
    }
    $con->close();
}

function generateUsernameByName($fName, $lName)
{
    $currentDate = date("Y-m-d");
    $username = substr($fName, 0, 1);
    $username .= $lName;
    $username .= substr($currentDate, 5, 2);
    $username .= substr($currentDate, 2, 2);      
    $username .= '%';    
    $con = connectDB();
    if ($stmt = $con->prepare('SELECT * FROM USERACCOUNT WHERE username LIKE ?')) {
        $stmt->bind_param('s', $username);
	    $stmt->execute();
        $stmt->store_result();
    	if ($stmt->num_rows == 0)
            $username = substr($username, 0, -1);
            $con->close();
            return ($username);
        }
        else {
            $num = $stmt->num_rows;
            $username = substr($username, 0, -1);
            $username .= $num;
            $con->close();
            return ($username);
        }
    }
}

function storePassword($id)
{
    $con = connectDB();
    // Check if the account with that username exists.
    if ($stmt = $con->prepare('SELECT * FROM USERACCOUNT WHERE ID = ?')) {
    	$stmt->bind_param('i', $id);
	    $stmt->execute();
        $stmt->store_result();
    	if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('SELECT password FROM USERACCOUNT WHERE ID = ?')) {
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->bind_result($password);
                $stmt->fetch();
                $stmt->close();                
                if($stmt = $con->prepare('INSERT INTO pastpassword (ID, Password) VALUES (?, ?)')) {
                    $stmt->bind_param("is", $id, $password);
                    $stmt->execute();

                    echo ("Account password has been stored into pastpassword table! ");
                }
                else{
                    echo ('Issue creating statement to store hashed password! ');
                }
            }
            else{
                echo ('Issue creating statement to pull account values! ');
            }
        } 
        else {
            echo ("Account not connected to entered ID. ");
        } 
    }
    $con->close();
}

function setSuspensionDates($id, $startDate, $endDate)
{
    $con = connectDB();
    // Check if the account with that username exists.
    if ($stmt = $con->prepare('SELECT * FROM USERACCOUNT WHERE ID = ?')) {
    	$stmt->bind_param('i', $id);
	    $stmt->execute();
	    $stmt->store_result();
    	if ($stmt->num_rows > 0) {
            if ($stmt = $con->prepare('UPDATE USERACCOUNT SET STARTSUSPEND = ?, ENDSUSPEND = ? WHERE ID = ?')) {
                $stmt->bind_param('ssi', $startDate, $endDate, $id);
                $stmt->execute();

                echo ('Account suspension dates have been set! ');
            }
            else{
                echo 'There was an error with the SQL statement.';
            }
        } 
        else {
            echo ("Account not connected to entered ID. ");
        }
    }

    $con->close();
}
   
function passwordRequirements ($unHashedPass) {
    $startsWithLetter= false;
    $longEnough= false;
    $containsNumber= false;
    $containsSC= false;

      $validLetters= array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
      $firstPassCharacter= substr($unHashedPass,0,1);
      for($x=0; $x < count($validLetters) ; $x++ ){
          if(strcasecmp($firstPassCharacter,$validLetters[$x]) == 0){
          
          $startsWithLetter= true;
          break;
         }
     }

  // Checks password criteria
     if(strlen($unHashedPass) >= 8){
         $longEnough= true;
     }
     if(preg_match("#[0-9]+#",$unHashedPass)){
         $containsNumber= true;
     }
     if(preg_match('/[^a-zA-Z\d]/', $unHashedPass)){
       $containsSC= true;
   }


if($startsWithLetter==false|| $longEnough==false || $containsNumber==false || $containsSC==false){
   exit("Please enter a password that has the required criteria.");
}
}


?>