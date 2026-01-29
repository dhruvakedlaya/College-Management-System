<?php
include 'student_dash_header.php';
if(isset($_SESSION['LoginStudent']))
        {
            $username = $_SESSION['LoginStudent'];
        }
        else
        {
            header('Location: login.php');
        }
        $conn = mysqli_connect("localhost","root","","cms");
        $qry="SELECT * from student where id='$username'";
        $res=mysqli_query($conn,$qry);
        $row = mysqli_fetch_assoc($res);
        $name=$row['name'];
        $course=$row['course'];
       
?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
    <style type="text/css">
        body{
            overflow: hidden;
        }
        .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
   
}

h1 {
    font-size: 30px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-size: 18px;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
form{
    max-width:309px;
}

/* Animation */
@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
   
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

form {
    background-color: white; 
    padding: 20px;
    border-radius: 5px;
    max-width:450px;
}

h1 {
    font-size: 30px;
    margin-bottom: 20px;
    color:white;
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Article Upload Form</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="rollnumber">Roll Number:</label>
                <input type="text" id="rollnumber" name="id" value="<?php echo $username; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" id="course" name="course" value="<?php echo $course; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="upload">
            </div>
        </form>
    </div>
</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST["submit"])) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    $id=$_POST['id'];

    

$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    echo"<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.);</script>";

    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo"<script>alert('Article not uploaded');</script>";
         echo "<script>window.location.href='upload.php';</script>";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Store image file path in the database
        $sql = "INSERT INTO article (id,image) VALUES ('$id','$targetFile')";
        if ($conn->query($sql) === TRUE) {
             echo"<script>alert('successfully uploaded article');</script>";
             echo "<script>window.location.href='upload.php';</script>";
       exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo"<script>alert('Article not uploaded');</script>";
        echo "<script>window.location.href='upload.php';</script>";
    }
}
}

$conn->close();
?>