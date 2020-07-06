<?php

include ('con.php');

    $safe_category_id = $_POST['category'];

    if (empty($safe_category_id)) {
        header ("Location: employee_list.php");
    }

    // Gather
    $get_list_sql = "SELECT * FROM Employees AS em
                    LEFT JOIN Category AS ca 
                    ON ca.CategoryID = em.CategoryID
                    WHERE em.CategoryId = '".$safe_category_id."'
                    ORDER BY em.ID
                    ";
    $get_list_res = mysqli_query($conn, $get_list_sql)
                    or die(mysqli_error($conn));

    if (mysqli_num_rows($get_list_res) < 1) {
        // there are no topics, so say so
        $display_block = "<p><em>No employee exist.</em></p>";    
    } 
    else 
    {
        $display_block =
            <<<END_OF_TEXT
            <table id="large">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Names</th>
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

    // output data of each row
    while ($row = mysqli_fetch_array($get_list_res)) {

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
                    <td><a onClick="javascript: return confirm('Are you sure?');" href="employee.php?empdel=1&empid=$id">delete</a></td>
                </tr>
            END_OF_TEXT;
    }

/// free results
    mysqli_free_result($get_list_res);

/// Close connection to MySQL
    $conn->close();

    }

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

                    echo "<select name='category'><option value=''>Sort by Employee Type</option><option value=''>ALL Employees</option>";

                    while($forum=mysqli_fetch_array($result)) {
                        echo "<option value=$forum[CategoryID]>$forum[Name]</option>";
                    }
                    
                    echo "</select>";

                /// Close connection to MySQL
                $conn->close();
            ?>

            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
        <p><a href="employee_list.php">All Employee</a> > <strong><?php echo $category ?></strong></p>
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