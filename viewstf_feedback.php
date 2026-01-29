<?php
if(isset($_POST['delete'])) {
    $conn = mysqli_connect("localhost","root","","cms");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "DELETE FROM feedbackstf";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('All feedback deleted successfully');</script>";
    } else {
        echo "Error deleting feedback: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Feedback</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h2 {
			text-align: center;
			color: #333;
		}
		table {
			border-collapse: collapse;
			width: 90%;
			margin: 0 auto;
			background-color: #fff;
			box-shadow: 0 2px 5px rgba(0,0,0,0.3);
			border-radius: 10px;
		}
		th, td {
			padding: 10px;
			text-align: center;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: #fff;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		

	</style>
</head>
<body>
	<h2>Student Feedback List</h2>
	<form action="viewstf_feedback.php" method=POST >
		<table>
			<tr>
				<th>id</th>
				<th>Name</th>
				<th>department</th>
				<th>Date</th>
				<th>Feedback</th>
			</tr>
			<?php
			$conn = mysqli_connect("localhost", "root", "", "cms");
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * FROM feedback";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "<tr>";
			        echo "<td>" . $row['id'] . "</td>";
			        echo "<td>" . $row['name'] . "</td>";
			        echo "<td>" . $row['depart'] . "</td>";
			       echo "<td>" . $row['date'] . "</td>";
			        echo "<td>" . $row['feedback'] . "</td>";
			        echo "</tr>";

			    }
			} else {
			    echo "<script>alert('No feedback found');window.location.href = 'admin_dash.php';</script>";
			}
			mysqli_close($conn);
			?>
		</table>
		<a href="admin_dash.php">Back</a>
		<input type="submit" name="delete" value="delete">
	</form>
</body>
</html>
