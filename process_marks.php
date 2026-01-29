<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    $type = $_POST['type'];
    $s1 = $_POST['subject1'];
    $s2 = $_POST['subject2'];
    $s3 = $_POST['subject3'];
    $s4 = $_POST['subject4'];
    $s5 = $_POST['subject5'];
    $s6 = $_POST['subject6'];
    $total = $_POST['total'];
    $avg = $_POST['average'];
    $grade = $_POST['grade'];

    // Check if type 1 marks already exist for the student
    $type1ExistsQuery = "SELECT * FROM marks WHERE id='$id' AND type=1";
    $type1ExistsResult = $con->query($type1ExistsQuery);

    if ($type == 2 && $type1ExistsResult->num_rows == 0) {
        echo "<script>alert('Please add Internal 1 marks first.');</script>";
        echo "<script>window.location.href='mark_form.php';</script>";
        exit;
    } else {
        // Check if marks already exist for the student and type
        $marksExistQuery = "SELECT * FROM marks WHERE id='$id' AND type='$type'";
        $marksExistResult = $con->query($marksExistQuery);

        if ($marksExistResult->num_rows > 0) {
            echo "<script>alert('Marks already added.');</script>";
            echo "<script>window.location.href='mark_form.php';</script>";
            exit;
        } else {
            $sql = "INSERT INTO marks (id, course, type, s1, s2, s3, s4, s5, s6, total, avg, grade) VALUES ('$id', '$course', $type, '$s1', '$s2', '$s3', '$s4', '$s5', '$s6', '$total', '$avg', '$grade')";
            $res = $con->query($sql);
            if ($res) {
                echo "<script>alert('Marks added successfully.');</script>";
                echo "<script>window.location.href='mark_form.php';</script>";
                exit;
            } else {
                echo "<script>alert('Failed to add marks.');</script>";
                echo "<script>window.location.href='mark_form.php';</script>";
                exit;
            }
        }
    }
}
?>
