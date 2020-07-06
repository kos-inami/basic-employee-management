<?php

include ('con.php');

if (isset($_GET["update"], $_GET["empId"])){
    $update = $_GET["update"];

    if ($update == 1) {
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
        $catid = $row['CategoryID'];

        $display_block =
        <<<END_OF_TEXT
            <p><strong>Employee Details Update: $lastname $firstname</strong></p>
            <form method="post" action="employee_update_done.php">
            <table class="details">
        END_OF_TEXT;
        
        //get category
        $get_cat_sql = "SELECT * FROM Category ORDER BY $catid";

        $get_cat_res = mysqli_query($conn, $get_cat_sql)
                        or die(mysqli_error($conn));
        
            if (mysqli_num_rows($get_cat_res) > 0) {
                
                $display_block .= "
                                <th>Employment Type</th>
                                <td>
                                <select id=\"CategoryID\" name=\"CategoryID\">
                                ";
                
                while ($cat = mysqli_fetch_array($get_cat_res)) {
                    $cat_name = $cat['Name'];
                    $cat_id = $cat['CategoryID'];
                    $display_block .= "<option value=\"".$cat_id."\">" .$cat_name. "</option>";
                }
    
                $display_block .= "</select></td>";
            }

        $display_block .=
        <<<END_OF_TEXT
            <tr>
                <th>Employee ID</th>
                <td>$id</td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><input type="text" id="LastName" name="LastName" value="$lastname" required> *</td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><input type="text" id="FirstName" name="FirstName" value="$firstname" required> *</td>
            </tr>
            <tr>
                <th>Birth Day</th>
                <td><input type="date" id="BirthDate" name="BirthDate" value="$birthdate" required> *</td>
            </tr>
            <tr>
                <th>Employee Date</th>
                <td><input type="date" id="EmployeeDate" name="EmployeeDate" value="$employeedate" required> *</td>
            </tr>
            <tr>
                <th>Image</th>
                <td><input type="text" id="Photo" name="Photo" value="$photo" required> *</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td><textarea id="Notes" name="Notes" rows="4" cols="50">$notes</textarea></td>
            </tr>
        </table>
        <br>
            <input type="hidden" id="ID" name="ID" value="$id">
                <button type="submit" name="submit" value="submit" onClick="javascript: return confirm('Are you sure?');">Submit</button>
                <button type="reset" value="reset">Reset</button>
        </form>
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