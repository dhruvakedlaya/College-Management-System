<?php
session_start();
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $staffId = $_SESSION['LoginStudent'];
    $newImage = $_FILES['new_image']['tmp_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pass = $_POST['pass'];
    // Validate the password
    if (strlen($pass) < 8) {
    echo "<script>alert('Password must be at least 8 characters long.');</script>";
    echo "<script>window.location.href = 'update_stud_prof.php';</script>";
    exit();
    }

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/", $pass)) {
    echo "<script>alert('Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.');</script>";
    echo "<script>window.location.href = 'update_stud_prof.php';</script>";
    exit();
    }

    // Database connection
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the current student details
    $getCurrentDetailsQuery = "SELECT * FROM student WHERE id='$staffId'";
    $currentDetailsResult = mysqli_query($con, $getCurrentDetailsQuery);
    if ($currentDetailsResult) {
        $currentDetails = mysqli_fetch_assoc($currentDetailsResult);

        // Check if any changes were made
        if (
            $currentDetails['name'] == $name &&
            $currentDetails['email'] == $email &&
            $currentDetails['phone'] == $phone &&
            $currentDetails['address'] == $address &&
            $currentDetails['pass'] == $pass &&
            empty($newImage)
        ) {
            echo "<script>alert('No changes were made.');</script>";
            echo "<script>window.location.href = 'update_stud_prof.php';</script>";
            exit();
        }
    }

    // Update the student details in the database
    $updateQuery = "UPDATE student SET name='$name', email='$email', phone='$phone', address='$address', pass='$pass' WHERE id='$staffId'";
    $result = mysqli_query($con, $updateQuery);
    $sql="UPDATE login set pass='$pass' where ID='$staffId'";
    $res= mysqli_query($con, $sql);
    if ($result&&$res) {
        // Check if a new image was uploaded
        if (!empty($newImage)) {
            // Delete the previous profile picture
            $deleteQuery = "SELECT image FROM student WHERE id='$staffId'";
            $deleteResult = mysqli_query($con, $deleteQuery);
            if ($deleteResult) {
                $row = mysqli_fetch_assoc($deleteResult);
                $previousImage = $row['image'];
                if (!empty($previousImage)) {
                    unlink($previousImage);
                }
            }

            // Upload and update the new profile picture
            $targetDirectory = "images/";
            $imageName = time() . "_" . basename($_FILES['new_image']['name']);
            $targetFilePath = $targetDirectory . $imageName;
            move_uploaded_file($newImage, $targetFilePath);

            $updateImageQuery = "UPDATE student SET image='$targetFilePath' WHERE id='$staffId'";
            $updateImageResult = mysqli_query($con, $updateImageQuery);

            if (!$updateImageResult) {
                echo "<script>alert('Failed to update image');</script>";
                echo "<script>window.location.href = 'update_stud_prof.php';</script>";
                exit();
            }
        }

        echo "<script>alert('Profile Updated Successfully');</script>";
        echo "<script>window.location.href = 'update_stud_prof.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error in updating');</script>";
        echo "<script>window.location.href = 'update_stud_prof.php';</script>";
        exit();
    }

    mysqli_close($con);
}
?>
