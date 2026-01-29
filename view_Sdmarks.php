<?php
    include 'student_dash_header.php';
    if (isset($_SESSION['LoginStudent'])) {
        $username = $_SESSION['LoginStudent'];
    } else {
        header('Location: index.php');
    }
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die(mysqli_error());
    }

    $sql = "SELECT course FROM student WHERE id='$username'";
    $reslt = $con->query($sql);
    $row = $reslt->fetch_assoc();
    $department = $row['course']; 

    $_SESSION['department'] = $department;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .navbar {
            background-color: black;
            padding: 10px;
            margin-top: 40px;
            border-radius: 20px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }

        .navbar li {
            margin-right: 10px;

        }

        .navbar a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            color: white;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
            border-radius: 10px;
        }

        .active {
            background-color: #ccc;
        }

        .content {
            margin-top: 20px;
            padding: 20px;
        }

        .result-card {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
            background-color: yellow;
            border-radius: 10px;
        }

        .result-card h2 {
            text-align: center;
        }

        .student-info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: center;
            border: 2px solid black;
            background-color: yellow;
            border-radius: 10px;
        }

        table th {
/*            background-color: #f2f2f2;*/
background-color: yellow;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #e5e5e5;
        }
    </style>
</head>
<body>
    <?php include 'student_dash_header.php'; ?>
    <div class="navbar">
        <ul>
            <li><a href="?course_type=1">1 Internal</a></li>
            <li><a href="?course_type=2">2 Internal</a></li>
           
        </ul>
    </div>

    <div class="content">
        <?php
            // Fetch and display student's marks of the selected course
            if (isset($_GET['course_type'])) {
                $selectedCourseType = $_GET['course_type'];

                // Fetch and display student's marks of the selected course
                $query = "SELECT student.id, student.name, marks.type, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6, marks.total, marks.avg, marks.grade
                FROM marks
                JOIN student ON student.id = marks.id
                WHERE marks.id='$username' AND marks.course = '" . mysqli_real_escape_string($con, $department) . "' AND marks.type = '" . mysqli_real_escape_string($con, $selectedCourseType) . "' AND student.status = 'available'";

                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $studentName = $row['name'];
                    $subject1 = $row['s1'];
                    $subject2 = $row['s2'];
                    $subject3 = $row['s3'];
                    $subject4 = $row['s4'];
                    $subject5 = $row['s5'];
                    $subject6 = $row['s6'];
                    $total = $row['total'];
                    $average = $row['avg'];
                    $grade = $row['grade'];

                    echo '<div class="result-card">';
                    echo '<h2>Result Card for ' . $selectedCourseType . ' Internal</h2>';
                    echo '<div class="student-info">';
                    echo '<p>Name: ' . $studentName . '</p>';
                    echo '</div>';
                    echo '<table>';
                    echo '<tr><th>Subject</th><th>Marks</th></tr>';
                    echo '<tr><td>Subject 1</td><td>' . $subject1 . '</td></tr>';
                    echo '<tr><td>Subject 2</td><td>' . $subject2 . '</td></tr>';
                    echo '<tr><td>Subject 3</td><td>' . $subject3 . '</td></tr>';
                    echo '<tr><td>Subject 4</td><td>' . $subject4 . '</td></tr>';
                    echo '<tr><td>Subject 5</td><td>' . $subject5 . '</td></tr>';
                    echo '<tr><td>Subject 6</td><td>' . $subject6 . '</td></tr>';
                    echo '<tr><td>Total</td><td>' . $total . '</td></tr>';
                    echo '<tr><td>Average</td><td>' . $average . '</td></tr>';
                    echo '<tr><td>Grade</td><td>' . $grade . '</td></tr>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="result-card">';
                    echo '<h2>Error</h2>';
                    echo '<p>Marks for ' . $selectedCourseType . ' Internal have not been added yet.</p>';
                    echo '</div>';
                }
            }
        ?>
    </div>
</body>
</html>
