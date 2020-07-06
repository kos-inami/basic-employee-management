<?php

include ('con.php');

/// Delete
if (isset($_GET["empdel"], $_GET["empId"])){
    if ($_GET["empdel"] == 1) {
        $prev_empid = $_GET["empId"];
        $sqlDelete = "DELETE FROM Employees WHERE ID = '" . $prev_empid . "' ";
        $rsDlete = $conn->query($sqlDelete);
    }
    header('Location: employee_list.php');
}

if (isset($_GET["details"], $_GET["empId"])){
    $deteails = $_GET["details"];

    if ($deteails == 1) {
        $empId = $_GET["empId"];
        $display_sql = "SELECT *
                        FROM Employees AS e 
                        LEFT JOIN Category AS c
                        ON c.CategoryID = e.CategoryID 
                        WHERE e.ID ='" . $empId . "'";
        $res_display_sql = $conn->query($display_sql);
        $row = $res_display_sql->fetch_assoc();

        $id = $row['ID'];
        $lastname = $row['LastName'];
        $firstname = $row['FirstName'];
        $birthdate = $row['BirthDate'];
        $employeedate = $row['EmployeeDate'];
        $category = $row['Name'];
        $photo = $row['Photo'];
        $notes = $row['Notes'];

        $display_block =
        <<<END_OF_TEXT
        <p><strong>Employee Details: $lastname $firstname</strong></p>
        <table class="details" >
            <tr>
                <th>Emplooy ID</th>
                <td>$id</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td>$lastname</td>
            </tr>
            <tr>
                <th>First Name</th>
                <td>$firstname</td>
            </tr>
            <tr>
                <th>Birth Day</th>
                <td>$birthdate</td>
            </tr>
            <tr>
                <th>Employee Date</th>
                <td>$employeedate</td>
            </tr>
            <tr>
                <th>Employment Type</th>
                <td>$category</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td><a href="emp_img/$photo" target="_bank"><img src="emp_img/$photo"></a></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>$notes</td>
            </tr>
        </table>
        <div class="direct">
            <a href="employee_list.php">Back to the employee list</a>
            <a href="employee_update.php?update=1&empId=$id">Update</a>
            <a onClick="javascript: return confirm('Are you sure?');" href="employee_details.php?empdel=1&empId=$id">Delete</a>
        </div>
        END_OF_TEXT;
    } else {
        echo "ERROR";
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