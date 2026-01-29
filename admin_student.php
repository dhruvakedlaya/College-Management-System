<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
	die(mysqli_err());
}
$qry="select * from staff";
$res=$con->query($qry);
$r=$res->num_rows;
$qry1="SELECT * FROM student";
$res1=$con->query($qry1);
$r1=$res1->num_rows;

$qry2="SELECT * FROM student where status='approved'";
$res2=$con->query($qry2);
$row2=$res2->num_rows;
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

	</div>

	<div class="content">
		
		<h1 align="center" style="margin-left:-20px">Student Managment</h1>
		
    <div class="dashboard" style="justify-content: space-around;">
		<div class="box">
			<h2><i class="fa-solid fa-graduation-cap"></i></h2>
			<p>Admit Student</p>
			<a href='addstd.php' class="btn-view"><i class="fas fa-user-edit"></i>Add student</a>
		</div>
		<div class="box">
			<h2><i class="fas fa-user-friends"></i></h2>
			<p>View Student</p>
			<a href="viewstd.php" class="btn-view"><i class="fa-solid fa-eye"></i>View</a>
		</div>
    <div class="box">
			<h2><i class="fas fa-chart-line"></i></h2>
			<p>Students Marks Report</p>
			<a href="view_Acourse.php" class="btn-view"><i class="fa-solid fa-eye"></i>View</a>
		</div>
		
	</div>
  <div class="footer">
    <button class="logout-btn"><a href='logout.php'>Logout</a></button>
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