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

/// Check connection
    $sql = "SELECT e.ID, c.Name, e.LastName, e.FirstName, e.BirthDate, e.Photo, e.EmployeeDate, e.Notes
            FROM Employees AS e
            LEFT JOIN Category AS c
            ON c.CategoryID = e.CategoryID
            ORDER BY e.ID
            ";
    $result = $conn->query($sql);

    $display_block =
        <<<END_OF_TEXT
        <table id="large">
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Birth Day</th>
                <th>Employee Date</th>
                <th>Employment type</th>
                <th>Photo</th>
                <th>Notes</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        END_OF_TEXT;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $id = $row['ID'];
        $lastname = $row['LastName'];
        $firstname = $row['FirstName'];
        $birthdate = $row['BirthDate'];
        $employeedate = $row['EmployeeDate'];
        $category = $row['Name'];
        $photo = $row['Photo'];
        $notes = $row['Notes'];

        $display_block .=
            <<<END_OF_TEXT
                <tr>
                    <td>$id</td>
                    <td>$lastname</td>
                    <td>$firstname</td>
                    <td>$birthdate</td>
                    <td>$employeedate</td>
                    <td>$category</td>
                    <td><img src="emp_img/$photo"></td>
                    <td><a href="employee_details.php?details=1&empId=$id">details</a></td>
                    <td><a href="employee_update.php?update=1&empId=$id">update</a></td>
                    <td><a onClick="javascript: return confirm('Are you sure?');" href="employee_list.php?empdel=1&empId=$id">delete</a></td>
                </tr>
            END_OF_TEXT;
    }

} else {
    echo "0 results";
}

$display_block .= "</tbody><table>";

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
        <div class="content">
        <form action="category.php" method="post">
            
            <?php
            include ('con.php');

                /// Choosing Category
                $cate_sql="SELECT * FROM Category";
                $result = mysqli_query($conn, $cate_sql);

                    echo "<select name='category'><option value=''>Sort by Employment Type</option>";

                    while($forum=mysqli_fetch_array($result)) {
                        echo "<option value=$forum[CategoryID]>$forum[Name]</option>";
                    }
                    
                    echo "</select>";

                /// Close connection to MySQL
                $conn->close();
            ?>

            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
        <p>*You can click and sorting by each table title</p>
        </div>

        <?php echo $display_block ?>

    </main>
</div>

<!-- //////////////////////////////////// 
Javascript
//////////////////////////////////// -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/employee.js"></script>
<script src="js/jquery.tablesorter.js"></script>

</body>
</html>


<!-- INSERT INTO `Employees`(`ID`, `CategoryID`, `LastName`, `FirstName`, `BirthDate`, `Photo`, `EmployeeDate`, `Notes`) VALUES ('10', '3', 'West', 'Adam', '1928-09-19', 'EmpID10.jpg', '2020-01-03', "An old chum."); -->