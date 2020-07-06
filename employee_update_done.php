<?php

include ('con.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect value of input field
    $eid = $_POST['ID'];
    $lname = $_POST['LastName'];
    $fname = $_POST['FirstName'];
    $bday = $_POST['BirthDate'];
    $eday = $_POST['EmployeeDate'];
    $ecat = $_POST['CategoryID'];
    $photo = $_POST['Photo'];
    $notes = $_POST['Notes'];

    // Updating
    $sqlUpdate = "UPDATE Employees
                SET CategoryID = '$ecat',
                    LastName = '$lname',
                    FirstName = '$fname',
                    BirthDate = '$bday',
                    EmployeeDate = '$eday',
                    Photo = '$photo',
                    Notes = '$notes'
                WHERE ID = '" . $eid . "'
                ";
    $rsUpdate = $conn->query($sqlUpdate);

    // Get category
    $cat_sql = "SELECT *
                FROM Category 
                WHERE CategoryID ='" . $ecat . "'
                ";
    $res_cat_sql = $conn->query($cat_sql);
    $catname = $res_cat_sql->fetch_assoc();

    $ecatname = $catname['Name'];

    if (empty($fname)){
        echo "Name is empty";
    } else {
        
        $display_block =
        <<<END_OF_TEXT
        <p><strong>SUCCESSED UPDATE</strong></p>
        <table class="details">
            <tr>
                <th>Employment Type</th>
                <td>$ecatname</td>
            </tr>
            <tr>
                <th>Emplooy ID</th>
                <td>$eid</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>$lname</td>
            </tr>
            <tr>
                <th>First Name</th>
                <td>$fname</td>
            </tr>
            <tr>
                <th>Birth Day</th>
                <td>$bday</td>
            </tr>
            <tr>
                <th>Employee Date</th>
                <td>$eday</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td><img src="emp_img/$photo"></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>$notes</td>
            </tr>
        </table>
        <div class="direct">
            <a href="employee_list.php">Back to the employee list</a>
        </div>
        END_OF_TEXT;
    }
} 

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYEE LIST</title>
    <link rel='stylesheet' href='css/employee.css'/>
</head>
<body>
<h1>EMPLOYEE MANAGEMENT</h1>
<div class="wrapper">

    <?php include('leftnav.php')?>

    <main>
        <?php echo $display_block ?>
    </main>
</div>
</body>
</html>