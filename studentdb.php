<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style4.css">
    </head>
    <body>
        <div class = "message">
            <?php
                $firstName = $_POST ['fnField'];
                $lastName = $_POST ['lnField'];
                $email = $_POST ['eField'];
                $sid = $_POST ['sidField'];
                $slot = $_POST ['slots'];

                if(checkFields($firstName, $lastName, $email, $sid))
                {
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
                        checkStudent($firstName, $lastName, $email, $sid, $slot, $mysqli);
                    }
                    $mysqli->close();
                }
                function checkFields($firstName, $lastName, $email, $sid)
                {
                    if($firstName == "" || $lastName == "" || $email == "" || $sid == "")
                    {
                        echo "Input fields are missing values";
                        return false;
                    }
                    return true;
                }
                function checkStudent($firstName, $lastName, $email, $sid, $slot, $mysqli)
                {
                    $sql = "SELECT slot FROM studentdb where id = '".$sid."'";
                    $result = mysqli_query($mysqli, $sql);
                    if (mysqli_num_rows($result) > 0) 
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            if($row['slot'] == $slot)
                            {
                                echo "Student is already registered into this section";
                            }
                            else
                            {
                                $sql = "DELETE FROM studentdb WHERE id = '".$sid."'";
                                if (mysqli_query($mysqli, $sql)) 
                                {
                                    echo "Student is migrated from Section: ".$row['slot'][3]." to Section: ".$slot[3]."<br>";
                                    insertValues($firstName, $lastName, $email, $sid, $slot, $mysqli);
                                } 
                                else 
                                {
                                    echo "Error: ".$sql."".mysqli_error($mysqli);
                                }
                            }
                        }
                    }
                    else
                    {
                        insertValues($firstName, $lastName, $email, $sid, $slot, $mysqli);
                    }
                }
                function insertValues($firstName, $lastName, $email, $sid, $slot, $mysqli)
                {
                    $sql = "INSERT INTO studentdb VALUES('".$firstName."', '".$lastName."', '".$sid."', '".$email."', '".$slot."')";
                    if (mysqli_query($mysqli, $sql)) 
                    {
                        echo "New record created successfully";
                    } 
                    else 
                    {
                        echo "Error: ".$sql."".mysqli_error($mysqli);
                    }
                }
            ?>
        </div>
    </body>
</html>