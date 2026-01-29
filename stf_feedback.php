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

$sql="SELECT  image from staff where id='$username'";
$reslt=$con->query($sql);
$row=$reslt->fetch_assoc();

$img=$row['image'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>College Management System - Staff Dashboard</title>
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
		<h1 align="center">Feedback Management</h1>

    <div class="dashboard">
		<div class="box">
			<h2><i class="fas fa-comment-alt"></i></h2>
			<p>Add Feedback</p>
			<a href='apply_stf_feed.php' class="btn-view"><i class="fas fa-comment-medical"></i> Add</a>
		</div>
		<div class="box">
			<h2><i class="fas fa-comments"></i></h2>
			<p>View Feedback</p>
			<a href='view_stf_feed.php' class="btn-view"><i class="fas fa-eye"></i> View</a>
		</div>	
	</form>
	 <div class="footer">
            <button class="logout-btn"><a href='logout.php'>Logout</a></button>
        </div>
    </div>
</div>
</form>
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
