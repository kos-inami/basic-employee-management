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
    <p><strong>Adding Employee</strong></p>
        <form method="post" action="do_add_employee.php">
        <table class="details">
            <tr>
                <th><label for="CategoryID">Employment Type</label></th>
                <td>
                <?php
                    include ('con.php');

                    $sql = "SELECT * FROM Category ORDER BY CategoryID";
                    $result = mysqli_query($conn, $sql);

                        echo "
                            <select name='category' id='category' required>
                            <option value=''>Select employment type</option>
                            ";

                    while ($forum = mysqli_fetch_array($result)) {
                        echo "<option value=$forum[CategoryID]>$forum[Name]</option>";
                    }
                        echo "
                            </select>
                            ";
                    
                    mysqli_close($conn);
                ?>
                </td>
            </tr>
            <tr>
                <th><label for="LastName">Last Name</label></th>
                <td><input type="text" id="LastName" name="LastName" required></input></td>
            </tr>
            <tr>
                <th><label for="FirstName">First Name</label></th>
                <td><input type="text" id="FirstName" name="FirstName" required></input></td>
            </tr>
            <tr>
                <th><label for="BirthDate">Birth Day</label></th>
                <td><input type="date" id="BirthDate" name="BirthDate" required></input></td>
            </tr>
            <tr>
                <th><label for="EmployeeDate">Employee Date</label></th>
                <td><input type="date" id="EmployeeDate" name="EmployeeDate" required></input></td>
            </tr>
            <tr>
                <th><label for="Photo">Photo (file name)</label></th>
                <td><input type="text" id="Photo" name="Photo" required></input></td>
            </tr>
            <tr>
                <th><label for="Notes">Note</label></th>
                <td><textarea id="Notes" name="Notes" rows="8" cols="40" ></textarea></td>
            </tr>
        </table>
            <br>
            <button type="submit" value="submit">ADD Employee</button>
            <button type="reset" value="reset">Reset</button>
        </form>
    </main>
</div>
</body>
</html>