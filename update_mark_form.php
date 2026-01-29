<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update mark form</title>
    <style>
        body {
            background: url("stu.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            top: 100px;
            font-family: Arial, sans-serif;
            overflow: hidden;
            background-size: cover;
        }
        

        .container {
            width: 400px;
            height: 450px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .container label,
        .container input[type="text"],
        .container input[type="submit"],
        .container a {
            display: block;
            margin-bottom: 10px;
        }

        .container input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            background-color: green;
            color: white;
            border: 1px solid black;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

         a {
           
        }

        .container a:hover {
            background-color: green;
        }

        .container .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .container .form-row label {
            flex-basis: 20%;
            text-align: right;
            padding-right: 10px;
        }

        .container .form-row input[type="number"] {
            flex-basis: 80%;
            padding: 5px;
            padding-bottom: 10px;
        }

        .container .form-row input[type="submit"] {
            flex-basis: 100%;
        }

         .back-link a {
            flex-basis: 100%;
        text-align: left;
        position: absolute;
        top: 550px;
        left: 10px;
        height: 20px;
        width: 80px;
        background-color: blue;
        padding: 10px;
        border-radius:5px;
        text-align: center;
        text-decoration: none;
        color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 align="center">Update Student Marks</h2>
        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die(mysqli_error($con));
        }
        $id = $_GET['id'];
        $type = $_GET['type'];

        $sql = "SELECT student.name, student.id, marks.type, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6 
                FROM marks JOIN student ON student.id = marks.id 
                WHERE marks.id = '$id' AND marks.type = '$type'";
        $res = $con->query($sql);
        $row = mysqli_fetch_assoc($res);

        $studid = $row['id'];
        $studentName = $row['name'];
        $subject1 = $row['s1'];
        $subject2 = $row['s2'];
        $subject3 = $row['s3'];
        $subject4 = $row['s4'];
        $subject5 = $row['s5'];
        $subject6 = $row['s6'];
        ?>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $studid; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <div class="form-row">
                <label for="studentName">Name:</label>
                <input type="text" id="studentName" name="studentName" value="<?php echo $studentName; ?>" readonly>
            </div>

            <div class="form-row">
                <label for="subject1">Subject 1:</label>
                <input type="number" id="subject1" name="subject1" min="0" max="100" value="<?php echo $subject1; ?>">
            </div>

            <div class="form-row">
                <label for="subject2">Subject 2:</label>
                <input type="number" id="subject2" name="subject2" min="0" max="100" value="<?php echo $subject2; ?>">
            </div>

            <div class="form-row">
                <label for="subject3">Subject 3:</label>
                <input type="number" id="subject3" name="subject3" min="0" max="100" value="<?php echo $subject3; ?>">
            </div>

            <div class="form-row">
                <label for="subject4">Subject 4:</label>
                <input type="number" id="subject4" name="subject4" min="0" max="100" value="<?php echo $subject4; ?>">
            </div>

            <div class="form-row">
                <label for="subject5">Subject 5:</label>
                <input type="number" id="subject5" name="subject5" min="0" max="100" value="<?php echo $subject5; ?>">
            </div>

            <div class="form-row">
                <label for="subject6">Subject 6:</label>
                <input type="number" id="subject6" name="subject6" min="0" max="100" value="<?php echo $subject6; ?>">
            </div>

            <div class="form-row">
                <input type="submit" name="submit" value="Update">
            </div>

            <div class="form-row back-link">
                <a href="view_Sfmark.php">Back</a>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $s1 = $_POST['subject1'];
        $s2 = $_POST['subject2'];
        $s3 = $_POST['subject3'];
        $s4 = $_POST['subject4'];
        $s5 = $_POST['subject5'];
        $s6 = $_POST['subject6'];

        $originalS1 = $subject1;
        $originalS2 = $subject2;
        $originalS3 = $subject3;
        $originalS4 = $subject4;
        $originalS5 = $subject5;
        $originalS6 = $subject6;

        if ($s1 == $originalS1 && $s2 == $originalS2 && $s3 == $originalS3 && $s4 == $originalS4 && $s5 == $originalS5 && $s6 == $originalS6) {
            echo "<script>alert('No changes made');</script>";
            echo "<script>window.location.href='view_Sfmark.php';</script>";
        } else {
            $total = $s1 + $s2 + $s3 + $s4 + $s5 + $s6;
            $average = $total / 6;
            $grade = '';

            if ($s1 >= 35 && $s2 >= 35 && $s3 >= 35 && $s4 >= 35 && $s5 >= 35 && $s6 >= 35) {
                if ($average >= 75) {
                    $grade = 'distinction';
                } else if ($average >= 65) {
                    $grade = 'first class';
                } else if ($average >= 55) {
                    $grade = 'second class';
                } else if ($average >= 35) {
                    $grade = 'pass class';
                } else {
                    $grade = 'fail';
                }
            } else {
                $grade = 'fail';
            }

            $updateMarksQry = "UPDATE marks SET s1='$s1', s2='$s2', s3='$s3', s4='$s4', s5='$s5', s6='$s6', total='$total', avg='$average', grade='$grade' WHERE id='$id' AND type='$type'";
            $updateMarksResult = $con->query($updateMarksQry);

            if (!$updateMarksResult) {
                die(mysqli_error($con));
            }

            echo "<script>alert('Marks updated successfully!!');</script>";
            echo '<script>window.location.href="view_Sfmark.php";</script>';
        }
    }
    ?>
</body>
</html>







