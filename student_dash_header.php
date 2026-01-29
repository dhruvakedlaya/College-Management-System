
 <?php
session_start();
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}
if (isset($_SESSION['LoginStudent'])) {
    $username = $_SESSION['LoginStudent'];
    
} else {
    header('Location: index.php');
}

$sql = "SELECT image FROM student WHERE id='$username'";
$reslt = $con->query($sql);
$row = $reslt->fetch_assoc();
$img = $row['image'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url(backgrounds/studback.jpg);
            background-size: cover;
            overflow: auto;
            height: 100vh;
        }

        .dashboard {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f0f0f0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            z-index: 999;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navigation {
            list-style-type: none;
            margin: 0;
            position: relative;
            right: 200px;
            padding: 0;
        }

        .navigation li {
            display: inline-block;
            margin-right: 10px;
        }

        .navigation li a {
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1;
            padding: 12px 0;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .b {
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
            position: relative;
            right: 50px;
            background-color: red;
            color: white;
            padding: 10px;
        }

        /* Light Mode */
        body.light-mode {
            background-color: #f2f2f2;
            color: #333;
        }

        body.light-mode .navigation li a {
            color: #333;
        }

        body.light-mode .navigation li a:hover {
            background-color: #333;
            color: #f2f2f2;
        }
        .logo{
        text-align: center;
        margin-top: 0px;
        }
        .logo img {

            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .con{
            position: relative;
            float: left;
            right: 240px;
        }
    </style>

</head>
<body class="light-mode">
<div class="dashboard">
    <div class="logo">
        <img src="<?php echo $img; ?>" alt="Student Avatar">&nbsp
        </div>
        <div class="con">
        <?php
        if (isset($_SESSION['LoginStudent'])) {
            $username = $_SESSION['LoginStudent'];
            echo " $username";
        } else {
            header('Location: index.php');
        }
        ?>
    </div>
    
    <ul class="navigation">
        <li>
            <a href="student_dash.php">HOME</a>
        </li>
        <li class="dropdown">
            <a href="#">Profile</a>
            <div class="dropdown-content">
                <a href="stud_prof.php">View Profile</a>
                <a href="update_stud_prof.php">Update Profile</a>
            </div>
        </li>
        <li><a href="view_stud_course.php">Courses</a></li>
        <li class="dropdown">
            <a href="#">Feedback</a>
            <div class="dropdown-content">
                <a href="student_feedback.php">Add Feedback</a>
                <a href="student_view_feedback.php">View Feedback</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Marks</a>
            <div class="dropdown-content">
                <a href="view_Sdmarks.php">View Marks</a>
                <a href="stud_query.php">Send Queries</a>
                <a href="std_qry.php">View Queries</a>
            </div>
        </li>
        <li><a href="student_view_notice.php">Notice</a></li>
        <li class="dropdown">
            <a href="#">Article</a>
            <div class="dropdown-content">
                <a href="upload.php">Add Article</a>
                <a href="view_studArt.php">View Article</a>
            </div>
        </li>
    </ul>
    <a href='logout.php' class="b">Logout</a>
</div>

</body>
</html>
