<?php
// Retrieve the item ID and status from the form submission
$leave_id = $_POST['leave_id'];
$status = $_POST['status'];

// Connect to the MySQL database (replace host, username, password, and dbname with your own details)
$con = mysqli_connect("localhost", "root", "", "cms");

// Check connection
if ($con->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Check if the leave application has already been approved or rejected
$checkStatusQuery = "SELECT status FROM staff_leave WHERE leave_id=$leave_id";
$checkStatusResult = $con->query($checkStatusQuery);
if ($checkStatusResult->num_rows > 0) {
    $row = $checkStatusResult->fetch_assoc();
    $existingStatus = $row['status'];
    
   
    if ($existingStatus !== 'pending') {
        echo "<script>alert('This leave application has already been $existingStatus.');</script>";
        echo "<script>window.location.href='view_leave.php';</script>";
        exit();
    }
}

// Prepare and execute the update statement
$uqry = "UPDATE staff_leave SET status='$status' WHERE leave_id=$leave_id";
$res = $con->query($uqry);

// Update the total leave in the staff table if the status is approved
if ($status == "approved") {
    // Retrieve the number of days leave for the current leave application
    $qqry = "SELECT num FROM staff_leave WHERE leave_id=$leave_id";
    $qres = $con->query($qqry);
    $row = $qres->fetch_assoc();
    $numDays = $row['num'];

    // Update the total leave in the staff table by decrementing the number of days leave
    $updqry = "UPDATE staff SET total_leave = total_leave - $numDays WHERE id IN (SELECT id FROM staff_leave WHERE leave_id=$leave_id)";
    $con->query($updqry);
}
$con->close();
header('Location: view_leave.php');
exit();
?>

