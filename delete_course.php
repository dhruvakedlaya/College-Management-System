<?php
$con = mysqli_connect("localhost", "root", "", "cms");


if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['sno'])) {
   
    $sno = $_GET['sno'];

    
    $checkQuery = "SELECT status FROM course WHERE sno = $sno";
    $result = mysqli_query($con, $checkQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];

        
        if ($status == 'Not Available') {
            echo "<script>alert('Course is already marked as Not Available');window.location.href = 'view_course.php';</script>";
            
        } else {
            
            $updateQuery = "UPDATE course SET status = 'Not Available' WHERE sno = $sno";

           
            if ($con->query($updateQuery) === TRUE) {
                
                echo "<script>alert('Course removed successfully');window.location.href = 'view_course.php';</script>";
                exit; 
            } else {
               
                echo "Error updating course status: " . $con->error;
            }
        }
    } else {
        
        echo "Course not found";
    }

   
    mysqli_free_result($result);
} else {
   
    echo "<script>alert('Course sno not provided'); window.location.href = 'admin_dash.php';</script>";
}

$con->close();
?>
