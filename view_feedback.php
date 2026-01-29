 <?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete'])) {
    $sno = $_POST['sno'];
    $sql = "DELETE FROM feedback WHERE fid = '$sno'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Feedback deleted successfully');</script>";
    } else {
        echo "Error deleting feedback: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Feedback</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background:url("backgrounds/feedback.jpg");
      background-size: cover;   

        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        label, select {
            padding: 5px;
        }

        input[type="submit"] {
            padding: 5px 20px;
            
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: black;
            color: #fff;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        h2{
            display: flex;
            justify-content: center;
        }
                .btn{
        float: left;
        width: 40px;
        height: 20px;
        display: flex;
        position: relative;
        align-items: center;
        border-radius: 5px;
        cursor: pointer;
        justify-content: center;
        color: white;
        text-decoration: none;
        background-color: blue;
        padding: 10px;
        bottom: 40px;
        left: 40px;
        position: fixed;
        }
        .btn:hover{
            background-color: green;
        }
        a{
            text-decoration: none;
        }
        .bn{
            float: right;
            right: 90px;
            position: absolute;
        }
        .feedback{
        width: 500px;
        white-space: normal;
/*        word-wrap: break-word;*/
        overflow-wrap: break-word;
        text-align: left;
        }
        .table-container {
            width: 90%;
            margin: 0 auto;
            max-height: 540px;
            overflow: auto;
            border-radius: 20px;
            opacity:0.9;
        }
        .del {
            background-color: red;
            color: white;
            border-radius: 5px;
            bottom:12px;
            position: relative;
        }
    </style>
</head>
<body>
    <h1>View Feedback</h1>
    <form method="POST" action="">
        <label for="role">Select Role:</label>
        <select id="role" name="role">
            <option value="staff">Staff</option>
            <option value="student">Student</option>
        </select>
        <input type="submit" name="submit" value="View feedback">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $role = $_POST['role'];
        if ($role == 'staff') {
            $query = mysqli_query($con, "SELECT s.id, s.name, s.depart, f.fid, f.date, f.feedback FROM feedback f JOIN staff s ON s.id=f.id  WHERE f.type = 'staff' ORDER BY f.date DESC");;
            echo "<h2>Staff Feedback</h2>";
            if (mysqli_num_rows($query) > 0) {
                echo "<div class='table-container'>";
                echo "<table>";
                echo "<tr>
                    <th>Id</th> 
                    <th>Name</th>
                    <th>Department</th>
                    <th>Date</th>
                    <th>Feedback</th>
                    <th>Action</th>
                </tr>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['depart'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td class='feedback'><div>" . $row['feedback'] . "</div></td>";

                    echo "<td>
                            <form method='POST'>
                                <input type='hidden' name='sno' value='" . $row['fid'] . "'>
                                <input type='submit' name='delete' class='del' value='Delete'>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "<script>alert('No staff feedback found');window.location.href = 'view_feedback.php';</script>";
            }
        } elseif ($role == 'student') {

            $query = mysqli_query($con, "SELECT s.id, s.name, s.course, f.fid, f.date, f.feedback FROM feedback f JOIN student s ON s.id=f.id  WHERE f.type = 'student' ORDER BY f.date DESC");

            echo "<h2>Student Feedback</h2>";
            if (mysqli_num_rows($query) > 0) {
                echo "<div class='table-container'>";
                echo "<table>";
                echo "<tr>
                    <th>Roll no</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Feedback</th>
                    <th>Action</th>
                </tr>";
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['course'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td class='feedback'><div>" . $row['feedback'] . "</div></td>";

                    echo "<td>
                            <form method='POST'>
                                <input type='hidden' name='sno' value='" . $row['fid'] . "'>
                                <input type='submit' name='delete' class='del' value='Delete'>
                            </form>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";

            } else {
                echo "<script>alert('No student feedback found');window.location.href = 'view_feedback.php';</script>";
            }
        } else {
            echo "Invalid role selected.";
        }
    }
    mysqli_close($con);
    echo "<br>";
    echo "<a class='btn' href='admin_dash.php'>Back</a>";
    
    ?>

</body>
</html>
