<?php
session_start();
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
	die(mysqli_err());
}

$qry="select * from staff where status='available'";
$res=$con->query($qry);
$r=$res->num_rows;


$qry2="SELECT * FROM student where status='available'";
$res2=$con->query($qry2);
$row2=$res2->num_rows;

$qry3="SELECT * from course where status='available'";
$res3=$con->query($qry3);
$row3=$res3->num_rows;

$qry="select * from feedback";
$re=$con->query($qry);
$ra=$re->num_rows;

$qry="select * from article";
$re=$con->query($qry);
$ra1=$re->num_rows;
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
<body onload="highlightActivePage()">
	<div class="header">
		<h1>College Management System</h1>
	</div>
	<form action="#" method="POST">
		<div class="sidebar">
			<div class="admin-info">
				<img src="icon.jpg" alt="Admin Avatar">
				<!-- <h2>
          <?php
          if (isset($_SESSION['LoginAdmin'])) {
              $username = $_SESSION['LoginAdmin'];
              echo "$username";
          } else {
              header('Location: index.php');
          }
          ?>
        </h2> -->
        <h2>Admin</h2>
				<p>Admin of college</p>
			</div>
			<ul>
				<li><link rel="stylesheet" href="dashStyle.css"><a href="admin_dash.php"><i class="fas fa-bars"></i>Dashboard</a></li>
				<li><a href="admin_Staff.php"><i class="fa-solid fa-chalkboard-user"></i>Staff</a></li>
				<li><a href="admin_student.php"><i class="fa-solid fa-graduation-cap"></i>Students</a></li>
				<li><a href="admin_course.html"><i class="fa-solid fa-book"></i>Courses</a></li>
				<li><a href="admin_notice.html"><i class="fa-regular fa-clipboard"></i>Notice</a></li>
			</ul>
			<div class="footer">
				<button class="logout-btn"><a href='logout.php'>Logout</a></button>
			</div>
		</div>

		<div class="content">
			<h1 align="center">Admin Dashboard</h1>
			<div class="dashboard">
				<div class="box">
					<i class="fas fa-graduation-cap box-icon"></i>
					<h2><?php echo $row2; ?></h2>
					<p>Total Students</p>
					<a href="view_student.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
				<div class="box">
					<i class="fas fa-chalkboard-user box-icon"></i>
					<h2><?php echo $r; ?></h2>
					<p>Total Staff</p>
					<a href="viewSTaF.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
				<div class="box">
					<i class="fas fa-book box-icon"></i>
					<h2><?php echo $row3; ?></h2>
					<p>Total Courses</p>
					<a href="view_course_qu.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
				<div class="box">
					<i class="fas fa-comments box-icon"></i>
					<h2><?php echo $ra; ?></h2>
					<p>Feedback</p>
					<a href="view_feedback.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
				</div>
        <div class="box">
					<i class="fas fa-comments box-icon"></i>
					<h2><?php echo $ra1; ?></h2>
					<p>Article</p>
					<a href="view_article.php" class="btn-view"><i class="fas fa-eye"></i> View</a>
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
</script>
</body>
</html>
