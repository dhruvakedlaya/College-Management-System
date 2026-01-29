<?php
// Retrieve the form data
$id= $_POST['id'];
$name=$_POST['name'];
$date=$_POST['date'];
$reason = $_POST['reason'];
$leaveType = $_POST['leave_type'];
$numDays = $_POST['num_days'];


$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cms';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT total_leave FROM staff where id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $totalLeave = $row['total_leave'];


if ($numDays <= $totalLeave) {
  
  $sql = "SELECT * FROM staff_leave WHERE id='$id' AND date='$date'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    
    echo "<script>alert('You have already applied for leave on this date!');</script>";
    echo "<script>window.location.href='apply_leave.php';</script>";
    exit;
  }

  
  $sql = "INSERT INTO staff_leave (id, type, date, num, reason, status) VALUES ('$id', '$leaveType', '$date', $numDays, '$reason', 'pending')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Leave application submitted successfully!');window.location.href='stf_leave.php';</script>";
   
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit;
  }
} else {
  echo "<script>alert('Insufficient leave days remaining!');</script>";
  echo "<script>window.location.href='stf_leave.php';</script>";
}



} else {
  echo "Staff not found!";
}

$conn->close();
?>
