<?php
$con = mysqli_connect("localhost", "root", "", "cms");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $sno = $_POST['sno'];
    $name = strtoupper($_POST['nm']);
    $fname = strtoupper($_POST['fnm']);
    $fs = $_POST['fe'];
    $des = $_POST['des'];
    $status = "available";

    
    $originalData = mysqli_query($con, "SELECT * FROM course WHERE sno='$sno' AND status='available'");
    $originalRow = mysqli_fetch_assoc($originalData);

   
    $nameChanged = $name !== $originalRow['cname'];
    $fnameChanged = $fname !== $originalRow['full'];
    $fsChanged = $fs !== $originalRow['fees'];
    $desChanged = $des !== $originalRow['des'];

    
    if ($nameChanged || $fnameChanged || $fsChanged || $desChanged) {
        $sql = "UPDATE course SET cname='$name', full='$fname', fees='$fs', des='$des' WHERE sno='$sno'";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Course updated successfully');window.location.href = 'view_course.php';</script>";
        } else {
            echo "Error updating course: " . mysqli_error($con);
        }
    } else {
        echo "<script>alert('No changes were made to the course.');</script>";
    }
}


if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];
    $sql = "SELECT * FROM course WHERE sno='$sno' AND status='available'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Course sno not provided'); window.location.href = 'view_course.php';</script>";
    exit;
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Course</title>
  
<style>
       
            body {
            background:url("backgrounds/course.jpg");
      background-size: cover;
        }
        

        .form-container {
            background: white;
            width: 30%;
            margin: auto;
            padding: 20px;
            position: relative;
            top: 60px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            opacity:0.9;
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

        a{
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
        <form action="" method="POST" accept-charset="UTF-8">
            <div class="form-group">

                <input type="hidden" name="sno" value="<?php echo $row['sno']; ?>">


                <label for="nm">Name of course:</label>
                <input type="text" name="nm" id="nm" placeholder="Enter course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" value="<?php echo $row['cname'];  ?>" required>
            </div>

            <div class="form-group">
                <label for="fnm">Full name:</label>
                <input type="text" name="fnm" id="fnm" placeholder="Enter full name of course" pattern="[A-Za-z ]+" title="Only alphabets and spaces are allowed" 
                value="<?php echo $row['full']; ?>" required>
            </div>

            <div class="form-group">
                <label for="fe">Total fees:</label>
                <input type="number" name="fe" id="fe" placeholder="Enter Total fees" pattern="[0-9]{5}" title="Please enter a 5-digit fees which is suitable for the course" value="<?php echo $row['fees']; ?>" required>
            </div>

            <div class="form-group">
                <label for="des">Descriptive about course:</label>
                 <textarea class="myTextbox" name="des" placeholder="Description" required><?php echo $row['des']; ?></textarea>

            </div>

            <div class="form-group">
               <input type="submit" name="submit" value="Update">
                <a href="view_course.php">Back</a>

            </div>
        </form>
    </div>
</body>
</html> 