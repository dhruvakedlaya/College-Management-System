<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error($con));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $course = $_POST['crs'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $tenth=$_POST['tenth'];
    $twlth=$_POST['twlth'];
    $pass=$_post['pass']


    // Retrieve existing details
    $selectQuery = "SELECT name, dob, course, email, phone, address FROM student WHERE id='$id'";
    $result = mysqli_query($con, $selectQuery);
    $row = mysqli_fetch_assoc($result);

    // Compare existing details with updated details
    $isSame = $row['name'] === $name && $row['dob'] === $dob && $row['course'] === $course && $row['email'] === $email && $row['phone'] === $phone && $row['address'] === $address && $row['tenth']==$tenth && $row['twlth']==$twlth &&$row['pass']==$pass;

    if ($isSame) {
        echo "<script>alert('No changes made to staff details');</script>";
        echo "<script>window.location.href = 'staff_details.php';</script>";
    } else {
        $updateQuery = "UPDATE student SET name='$name', dob='$dob', course='$course', email='$email', phone='$phone', address='$address' , tenth=$tenth, twlth=$twlth, pass='$pass' WHERE id='$id'";

        if (mysqli_query($con, $updateQuery)) {
            echo "<script>alert('Student details updated successfully');</script>";
            echo "<script>window.location.href = 'viewstd.php';</script>";
        } else {
            echo "<script>alert('Error updating student details');</script>";
            echo "<script>window.location.href = 'staff_details.php';</script>";
        }
    }
}

mysqli_close($con);
?>
