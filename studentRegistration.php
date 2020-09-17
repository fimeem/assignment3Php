<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "student";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT count(*) as count FROM studentdb where slot = 'sec1'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) 
        {
            if($row['count'] >= 8)
            {
                $option1 = '<option hidden selected disabled value = ""></option>';
            }
            else
            {
                $option1 = '<option value = "sec1">Sec:01 Sun, Tue 08:00-09:20 '.(8 - $row['count']).' seat(s) remaining</option>';
            }
        }
    }
    else
    {
        $option1 = '<option value = "sec1">Sec:01 Sun, Tue 08:00-09:20 8 seat(s) remaining</option>';
    }
    $sql = "SELECT count(*) as count FROM studentdb where slot = 'sec2'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            if($row['count'] >= 8)
            {
                $option2 = '<option hidden selected disabled value = ""></option>';
            }
            else
            {
                $option2 = '<option value="sec2">Sec:02 Mon, Wed 09:30-10:50 '.(8 - $row['count']).' seat(s) remaining</option>';
            }
        }
    }
    else
    {
        $option2 = '<option value="sec2">Sec:02 Mon, Wed 09:30-10:50 8 seat(s) remaining</option>';
    }
    $sql = "SELECT count(*) as count FROM studentdb where slot = 'sec3'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            if($row['count'] >= 8)
            {
                $option3 = '<option hidden selected disabled value = ""></option>';
            }
            else
            {
                $option3 = '<option value="sec3">Sec:03 Sun, Tue 11:00-12:20 '.(8 - $row['count']).' seat(s) remaining</option>';
            }
        }
    }
    else
    {
        $option3 = '<option value="sec3">Sec:03 Sun, Tue 11:00-12:20 8 seat(s) remaining</option>';
    }
    $sql = "SELECT count(*) as count FROM studentdb where slot = 'sec4'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_assoc($result))
        {
            if($row['count'] >= 8)
            {
                $option4 = '<option hidden selected disabled value = ""></option>';
            }
            else
            {
                $option4 = '<option value="sec4">Sec:04 Mon, Wed 12:30-01:50 '.(8 - $row['count']).' seat(s) remaining</option>';
            }
        }
    }
    else
    {
        $option4 = '<option value="sec4">Sec:04 Mon, Wed 12:30-01:50 8 seat(s) remaining</option>';
    }

    mysqli_close($conn);
?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>
        <form name = "Student" method = "POST" action = "studentdb.php">
            <header>
                <h1>Student Registration Form</h1>
            </header>
            <div class="registerPan">
                <div class="register">
                    <label for="fnField">First Name:</label>
                    <input type="string" id="fnField" name="fnField">
                </div>
                <div class="register">
                <label for="lnField">Last Name:</label>
                    <input type="string" id="lnField" name="lnField">
                </div>
                <div class="register">
                    <label for="sidField">Student ID:</label>
                    <input type="id" id="sidField" name="sidField">
                </div>
                <div class="register">
                    <label for="eField">Email:</label>
                    <input type="email" id="eField" name="eField">
                </div>
                <div class="register">
                    <label for="slots">Select Slot:</label>
                    <select name = "slots" if = "slot">
                        <?php echo $option1; ?>
                        <?php echo $option2; ?>
                        <?php echo $option3; ?>
                        <?php echo $option4; ?>
                    </select>
                </div>
                <div class="register">
                    <button type="submit" id="register_button">Register</button>
                    <button type="reset" id="clear_button">Clear</button>
                </div>
            </div>
        </form>
        <script src = "script1.js" charset="utf-8"></script>
    </body>
</html>