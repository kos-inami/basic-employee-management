<?php

include ('con.php');

/// Create safe values for input into the database
    $clean_category = mysqli_real_escape_string($conn, $_POST['category']);
    $clean_lname = mysqli_real_escape_string($conn, $_POST['LastName']);
    $clean_fname = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $clean_bdate = mysqli_real_escape_string($conn, $_POST['BirthDate']);
    $clean_edate = mysqli_real_escape_string($conn, $_POST['EmployeeDate']);
    $clean_photo = mysqli_real_escape_string($conn, $_POST['Photo']);
    $clean_notes = mysqli_real_escape_string($conn, $_POST['Notes']);

/// Get category name
    $get_category_name = "SELECT * FROM Category 
                        WHERE CategoryID = '".$clean_category."'";
    $get_category_res = mysqli_query($conn, $get_category_name)
                        or die(mysqli_error($conn));

    while ($category_info = mysqli_fetch_array($get_category_res)) {
            $category_name = $category_info['Name'];
    }

/// Create and issue the first query
    $add_employee_sql = "INSERT INTO Employees
                        (
                        CategoryID,
                        LastName,
                        FirstName,
                        BirthDate,
                        Photo,
                        EmployeeDate,
                        Notes
                        )
                        VALUES (
                                '".$clean_category."', 
                                '".$clean_lname."', 
                                '".$clean_fname."', 
                                '".$clean_bdate."', 
                                '".$clean_photo."', 
                                '".$clean_edate."', 
                                '".$clean_notes."' 
                                )";

    $add_employee_res = mysqli_query($conn, $add_employee_sql)
                        or die(mysqli_error($conn));

    $display_block = 
    <<<END_OF_TEXT
        <p><strong>Added New Empoloyee: $clean_lname $clean_fname</strong></p>
        <table class="details" >
            <tr>
                <th>Last Name</th>
                <td>$clean_lname</td>
            </tr>
            <tr>
                <th>First Name</th>
                <td>$clean_fname</td>
            </tr>
            <tr>
                <th>Birth Day</th>
                <td>$clean_bdate</td>
            </tr>
            <tr>
                <th>Employee Date</th>
                <td>$clean_edate</td>
            </tr>
            <tr>
                <th>Employee Type</th>
                <td>$category_name</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td><a href="emp_img/$clean_photo" target="_bank"><img src="emp_img/$clean_photo" alt="$clean_photo"></a></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>$clean_notes</td>
            </tr>
        </table>
        <div class="direct">
            <a href="employee_list.php">Back to the employee list</a>
        </div>
    END_OF_TEXT;

//free results
    mysqli_free_result($get_category_res);

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD EMPLOYEE</title>
    <link rel='stylesheet' href='css/employee.css'/>
</head>
<body>
<h1>EMPLOYEE MANAGEMENT</h1>
<div class="wrapper">

    <?php include('leftnav.php')?>

    <main>
        <?php echo $display_block; ?>
    </main>
</div>
</body>
</html>