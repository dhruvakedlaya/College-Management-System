<!DOCTYPE html>
<html>
<head>
    <title>Student View</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
       body{
            background: url("stu.jpg");
            background-size: cover;
            overflow: hidden;
            height: 100vh;
        }

        .table-container {
            width: 100%;
            margin: 0 auto;
            max-height: 540px;
            overflow: auto;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            background-color: transparent;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #000;
        }

        
        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table-heading {
            position: sticky;
            top: 0;
            background-color: black; 
            color: #fff; 
            z-index: 1;
        }

        th {
            background-color: black;
            color: #fff;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
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
            bottom: 20px;
            left: 20px;
            position: fixed;
        }

        .a:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <h1 style="color: #000;">Student View</h1>
    <div class="table-container">
        <?php
        session_start();
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_SESSION['LoginStaff'])) {
            $username = $_SESSION['LoginStaff'];

            $qry = "SELECT image, depart FROM staff WHERE id= '$username'";
            $res = $con->query($qry);
            if ($res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $imagePath = $row['image'];
                $department = $row['depart'];

                $qry_students = "SELECT * FROM student WHERE course = '$department' AND status = 'available'";
                $res_students = $con->query($qry_students);

                if ($res_students->num_rows > 0) {
                    echo "<table>";
                    echo "<tr class='table-heading'>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Father</th>
                        <th>mother</th>
                        <th>Email</th>
                        <th>Phone no</th>
                        <th>Date of birth</th>
                        <th>Gender</th>
                        <th>Course</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>";
                    while ($row = $res_students->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo '<td><img src="' . $row['image'] . '" height="100px" width="100px"></td>';
                        echo '<td>' . $row['fname'] . '</td>';
                        echo '<td>' . $row['mname'] . '</td>'; 
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='no-data'>No students found in the department.</p>";
                }
            }
        }

        mysqli_close($con);
        ?>
    </div>
   <a href="staff_dsh.php">Back</a>
</body>
</html>
