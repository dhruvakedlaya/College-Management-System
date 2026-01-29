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
    <title>College Feedback Form</title>
    <style type="text/css">
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    overflow:hidden;
}

h1 {
    text-align: center;
    color: white;
    margin-top: 80px;
}

form {
    width: 30%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
   
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    height: 480px;
}

label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"], input[type="email"], input[type="number"], textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
    resize: none;
}

input[type="submit"], input[type="reset"]  {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    float: left;
}

input[type="submit"]:hover {
    background-color: #00640;
}
input[type="reset"]:hover{
    
}
input[type="reset"]  {
    float: right;
    position: relative;
    left: 3px;
    background-color:red;
    padding: 12px 30px;
    border-radius: 4px;
    }
.btn{
    
    background-color: blue;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
}
.btn:hover{
    background-color: #45a049;
}
a{
    text-decoration: none;
    color: white;
}

    </style>
</head>
<body>
    <h1>College Feedback Form</h1>
    <form method="POST">
        <label>Roll Number:</label>
        <input type="text"  name="id" value="<?php echo $username; ?>" readonly><br><br>
        <label>Name:</label>
        <input type="text"  name="name" value="<?php echo $name; ?>"readonly><br><br>
         <label>Course:</label>
        <input type="text"  name="course" value="<?php echo $course; ?>" readonly><br><br>
        <label>Feedback:</label><br>
        <textarea id="feedback" name="feedback" rows="5" cols="50" required></textarea><br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" value="Clear" style="float:center;">
    </form>
</body>
</html>




<?php
 
 
    if(isset($_POST['submit'])) {
    // code to insert feedback into database


    $conn = mysqli_connect("localhost","root","","cms");
    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $course = $_POST['course'];
    $date = date('Y-m-d');
    $feedback = $_POST['feedback'];
    $type="student";

    // insert the feedback into the database
    $sql = "INSERT INTO feedback (id,date,feedback,type) VALUES ('$id','$date','$feedback','$type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Feedback submitted successfully');</script>";
        echo "<script>window.location.href='student_dash.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // close the database connection
    mysqli_close($conn);
    }
?>

