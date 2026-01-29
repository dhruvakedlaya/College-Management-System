<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $courseName = strtoupper($_POST['nm']);
    $fullName = strtoupper($_POST['fnm']);

    
    $query = "SELECT * FROM course WHERE cname = '$courseName' OR full = '$fullName'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        
        echo "<script>alert('Course with the same name or full name already exists.'); window.location.href='addCourse.php';</script>";
    } else {
       
        $fees = $_POST['fe'];
        $description = $_POST['des'];
        $status = 'available'; 

       
        $insertQuery = "INSERT INTO course (cname, full, fees, des, status) VALUES ('$courseName', '$fullName', '$fees', '$description','$status')";
        mysqli_query($con, $insertQuery);

        
        echo "<script>alert('Course added successfully!');window.location.href='admin_course.html';</script>";

    }
}


mysqli_close($con);
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="demo.css">
    <title>Course</title>
    <style>
        body {
            background:url("backgrounds/course.jpg");
      background-size: cover;
        }

        .form-container {
			opacity: 0.9;
            background: white;
            width: 30%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            position: relative;
            top: 60px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 95%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .form-group textarea {
            height: 200px;
            width: 95%;
            font-size: 16px;
            resize: none;
        }

        a {
            margin-top: 20px;
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100px;
            cursor: pointer;
            float: right;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Course</h2>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="nm">Name of course:</label>
                <input type="text" name="nm" id="nm" placeholder="Enter course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>
            </div>

            <div class="form-group">
                <label for="fnm">Full name:</label>
                <input type="text" name="fnm" id="fnm" placeholder="Enter full name of course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" required>
            </div>

            <div class="form-group">
                <label for="fe">Total fees:</label>
                <input type="number" name="fe" id="fe" placeholder="Enter Total fees" pattern="[0-9]{5}" title="Please enter a 5-digit fees which is suitable for the course" required>
            </div>

            <div class="form-group">
                <label for="des">Descriptive about course:</label>
                <textarea name="des" id="des" placeholder="Enter some detail about course" required></textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
                <a href="admin_course.html">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
