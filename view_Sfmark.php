<?php
session_start();
if (isset($_SESSION['LoginStaff'])) {
    $username = $_SESSION['LoginStaff'];
} else {
    header('Location: index.php');
}
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$sql = "SELECT depart from staff where id='$username'";
$reslt = $con->query($sql);
$row = $reslt->fetch_assoc();
$department = $row['depart']; // Change the department based on the logged-in staff

$_SESSION['department'] = $department;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Navigation</title>
    <style>
        body {
            background: url("stu.jpg");
            overflow: hidden;
            background-size: cover;
            height: 100vh;
        }
        .navbar {
/*            background-color: #f2f2f2;*/
            background-color: black;
            border-radius: 10px;
        }

        .navbar ul {
           
            padding: 0;
            list-style-type: none;
            display: flex;
            justify-content: space-around;

        }

        .navbar li {
            margin-right: 10px;
        }

        .navbar li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: white;

        }

        .navbar li a:hover {
            background-color: #ddd;
            color: black;
            border-radius: 10px;
        }
        
        .table-container {
            width: 95%;
            margin: 0 auto;
            max-height: 540px;
            overflow: auto;
            border-radius: 20px;
            /* opacity: 0.7; */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        td{
            padding: 15px;
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


        .a {
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
            background-color: #000080;
        }

        .error-message {
                text-align: center;
                color: red;
                font-size: 20px;
                margin-top: 30px;
              }
        .course-name {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            color: black;
        }
        .update-button {
            background-color: blue;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            height: 20px;
            width: 80px;
            display: inline-block;
          }

          .update-button:hover {
            background-color: green;
          }
    </style>
</head>
<body>
    <div class="course-name"><?php echo "Marks of " . $department . " student"; ?></div>

<div class="navbar">
    <ul>
        <li><a href="?course_type=1" >Internal 1</a></li>
        <li><a href="?course_type=2" >Internal 2</a></li>
    </ul>
</div>

<?php
if (isset($_GET['course_type'])) {
    $selectedCourseType = $_GET['course_type'];

    // Fetch and display students' marks of the selected course
    $query = "SELECT student.id, student.name, marks.type, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6, marks.total, marks.avg, marks.grade
    FROM marks
    JOIN student ON student.id = marks.id
    WHERE marks.course = '" . mysqli_real_escape_string($con, $department) . "' AND marks.type = " . $selectedCourseType . " AND student.status='available'";
    $result = $con->query($query);
    if ($result->num_rows > 0) {
        echo '<div class="table-container">
                <table>
                    <thead>
                        <tr class="table-heading">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>S1</th>
                            <th>S2</th>
                            <th>S3</th>
                            <th>S4</th>
                            <th>S5</th>
                            <th>S6</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['type'] . '</td>
                    <td>' . $row['s1'] . '</td>
                    <td>' . $row['s2'] . '</td>
                    <td>' . $row['s3'] . '</td>
                    <td>' . $row['s4'] . '</td>
                    <td>' . $row['s5'] . '</td>
                    <td>' . $row['s6'] . '</td>
                    <td>' . $row['total'] . '</td>
                    <td><a class="update-button" href="update_mark_form.php?id=' . $row['id'] . '&type=' . $row['type'] . '">Update</a></td>
                  </tr>';
        }

        echo '</tbody>
            </table>
        </div>';
    } else {
        echo '<p class="error-message">No results found.</p>';
    }
}
?>
 <a href='add_marks.php' class='a'>Back</a>
</body>
</html>
