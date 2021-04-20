<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'applicationdomain';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = "SELECT faccountID, faccount, fcategory, normalside, fbalance, active FROM faccount";
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_array($result)){
    
    $row['faccount'] = "<a href='ledger.php?u=".$row['faccountID']."'>" . $row['faccount'] . "</a>";

    switch ($row['fcategory']){
        case 1:
            $row['fcategory'] = "Asset";
            break;
        case 2: 
            $row['fcategory'] = "Liability";
            break;
        case 3:
            $row['fcategory'] = "Equity";
            break;
        case 4:
            $row['fcategory'] = "Revenue";
            break;
        case 5:
            $row['fcategory'] = "Expense";
            break;
    }

    if ($row['normalside'] == 0)
        $row['normalside'] = "Debit";
    else
        $row['normalside'] = "Credit";

    $row['active'];
    if ($row['active'] == 0)
        $row['active'] = "Deactivated";
    else
        $row['active'] = "Active";

    $acctDetailsLink = "<a href='accountdetails.php?u=".$row['faccountID']."'>Details</a>";
    $row[6] = $acctDetailsLink;
    $row['details'] = $acctDetailsLink;

    $editAcctLink = "<a href='editaccount.php?u=".$row['faccountID']."'>Edit</a>";
    $row[7] = $editAcctLink;
    $row['edit'] = $editAcctLink;
    
    $data[] = $row;
}

$results = ["draw" => 1,
        	"recordsTotal" => count($data),
        	"data" => $data ];

echo json_encode($results);
?>