 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Details</title>
    <style type="text/css">
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

    .back-button {
        margin-top: 20px;
        background-color: blue;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 90px;
        text-decoration: none;
        display: flex;
        position: fixed;
        bottom: 20px;
        right: 20px;
        align-items: center;
        justify-content: center;
    }

    .back-button:hover {
        background-color: #3e8e41;
    }
    .a{
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
    .a:hover{
        background-color: #3e8e41;
    }
    </style>
</head>
<body>
    <h1 align="center">Student Details</h1>
    
    <div class="table-container">
        <table>
            <thead class="table-heading">
                <tr>
                    <th>Roll number</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Email</th>
                    <th>Phone no.</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>10th%</th>
                    <th>PUC%</th>
                    <th>Course</th>
                    <th>Address</th>
                    <th>Password</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "cms");
                if (!$conn) {
                    die('Failed to connect to the database: ' . mysqli_connect_error());
                }

                $show = isset($_GET['show']) ? $_GET['show'] : 'all';
                $buttonName = $show == 'not_available' ? 'All Students' : 'Not Available Students';

                if ($show == 'not_available') {
                    $sql = "SELECT * FROM student WHERE status = 'Not Available'";
                } else {
                    $sql = "SELECT * FROM student WHERE status ='available'";
                }

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Failed to retrieve student data: ' . mysqli_error($conn));
                }
                if (mysqli_num_rows($result) == 0) {
                    echo "<script>alert('No ".$show." student  records found.'); window.location.href='admin_dash.php';</script>";
                    
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td><img src="' . $row["image"] . '" height="100px" width="100px"></td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['fname'] . '</td>';
                    echo '<td>' . $row['mname'] . '</td>'; 
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['dob'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                    echo '<td>' . $row['tenth'] . '</td>';
                    echo '<td>' . $row['twlth'] . '</td>';
                    echo '<td>' . $row['course'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['pass'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '</tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <a class="a" href="admin_dash.php">Back</a>
   <a href="?show=<?php echo $show == 'not_available' ? 'all' : 'not_available'; ?>" class="back-button"><?php echo $buttonName; ?></a>
</body>
</html>