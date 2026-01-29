<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error($con)); // Add $con as an argument
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Retrieve existing details
    $selectQuery = "SELECT name, db, qual, eid, num, adr FROM staff WHERE id='$id'";
    $result = mysqli_query($con, $selectQuery);
    $row = mysqli_fetch_assoc($result);

    // Compare existing details with updated details
    $isSame = $row['name'] === $name && $row['db'] === $dob && $row['qual'] === $qualification && $row['eid'] === $email && $row['num'] === $phone && $row['adr'] === $address;

    if ($isSame) {
        echo "<script>alert('No changes made to staff details');</script>";
        echo "<script>window.location.href = 'staff_details.php';</script>";
    } else {
        $updateQuery = "UPDATE staff SET name='$name', db='$dob', qual='$qualification', eid='$email', num='$phone', adr='$address' WHERE id='$id'";

        if (mysqli_query($con, $updateQuery)) {
            echo "<script>alert('Staff details updated successfully');</script>";
            echo "<script>window.location.href = 'staff_details.php';</script>";
        } else {
            echo "<script>alert('Error updating staff details');</script>";
            echo "<script>window.location.href = 'staff_details.php';</script>";
        }
    }
}

mysqli_close($con);
?>
