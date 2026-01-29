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

$sql="SELECT depart, image from staff where id='$username'";
$reslt=$con->query($sql);
$row=$reslt->fetch_assoc();
$department = $row['depart'];
$img=$row['image'];
$_SESSION['department'] = $department;


$qry = "SELECT * FROM student WHERE status='available' AND course='$department'";
$res = $con->query($qry);
$r = $res->num_rows; 

$qry3 = "SELECT * FROM course WHERE status='available'";
$res3 = $con->query($qry3);
$row3 = $res3->num_rows;

$qry4 = "SELECT * FROM article";
$res4 = $con->query($qry4);
$row4 = $res4->num_rows;
?>
<!DOCTYPE html>
<html>
<head>
    <title>College Management System - Admin Dashboard</title>
    
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/dashStyle.css">
    <style type="text/css">
        .sidebar ul li.active a {
              background-color: #ccc;
              color: black;
              border-bottom: 5px solid blue;
            }
        .sidebar ul li a i {
            padding-right: 30px;
            font-size: 16px;
            position: relative;
            left: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>College Management System</h1>
</div>
<form method="POST">
    <div class="sidebar">
        <div class="admin-info">
            <img src="<?php echo $img; ?>" alt="Admin Avatar">
            <h2><?php echo $username; ?></h2>
            <p>Staff</p>
        </div>
        <ul>
            <li><a href="staff_dsh.php"><i class="fas fa-bars"></i>Dashboard</a></li>
            <li><a href="staff_prof.php"><i class="fa-solid fa-user"></i>Profile</a></li>
            <li><a href="stf_leave.php"><i class="fas fa-calendar-times leave-icon"></i>Leave</a></li>
            <li><a href="add_marks.php"><i class="fas fa-check marks-icon"></i>Marks</a></li>
            <li><a href="stf_feedback.php"><i class="fas fa-comment"></i>Feedback</a></li>
        </ul>
    </div>

    <div class="content">
        <h1 align="center">Staff Dashboard</h1>

        <div class="dashboard">
            <div class="box">
                <i class="fas fa-graduation-cap box-icon"></i>
                <h2><?php echo $r; ?></h2>
                <p>Total Student</p>
                <a href="staff_view_stud.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
            </div>
            <div class="box">
                <i class="fas fa-book box-icon"></i>
                <h2><?php echo $row3; ?></h2>
                <p>COURSE</p>
                <a href="stf_view_course.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
            </div>
            <div class="box">
                <i class="fas fa-comments box-icon"></i>
                <h2><?php echo $row4; ?></h2>
                <p>ARTICLE</p>
                <a href="v_Sart.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
            </div>
        </div>
        <div class="footer">
            <button class="logout-btn"><a href='logout.php'>Logout</a></button>
        </div>
    </div>

    <script type="text/javascript">
        function highlightActivePage() {
            var currentLocation = window.location.href;
            var sidebarLinks = document.querySelectorAll('.sidebar ul li a');

            sidebarLinks.forEach(function(link) {
                if (link.href === currentLocation) {
                    link.parentNode.classList.add('active');
                }
            });
        }

        highlightActivePage();
    </script>

</body>
</html>
