<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style3.css">
    </head>
    <body>
        <form name = "Student" method = "POST">
            <header>
                <h1>Student Enrollment Information</h1>
            </header>
            <div class="infoPan">
                <div class="info_field">
                    <label for="slots">Select Slot:</label>
                    <select name="slots" id="slot">
                        <option value="sec1">Sec:01 Sun, Tue 08:00-09:20</option>
                        <option value="sec2">Sec:02 Mon, Wed 09:30-10:50</option>
                        <option value="sec3">Sec:03 Sun, Tue 11:00-12:20</option>
                        <option value="sec4">Sec:04 Mon, Wed 12:30-01:50</option>
                    </select>
                    <button type="submit" name="submit" id="search_button">Search</button>
                </div>
                <div class="student_box">
                    <?php
                        $host = "localhost";
                        $username = "root";
                        $password = "root";
                        $dbName = "student";
    
                        $mysqli = new mysqli($host, $username, $password, $dbName);
    
                        if ($mysqli -> connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                            exit();
                        }
                        else
                        {
                            if(isset($_POST['submit']))
                            {
                                $sql = "SELECT * FROM studentdb where slot = '".$_POST['slots']."'";
                                $result = mysqli_query($mysqli, $sql);
                                if (mysqli_num_rows($result) > 0) 
                                {
                                    echo "<table border='1'><tr><th>First Name</th><th>Last Name</th><th>Student ID</th><th>Email</th></tr>";
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr><td>".$row['firstname']."</td><td>".$row['secondname']."</td><td>".$row['id']."</td><td>".$row['email']."</td>";
                                    }
                                    echo "</table>";
                                }
                                else
                                {
                                    echo "No student found";
                                }
                            }
                        }
                        $mysqli->close();
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>