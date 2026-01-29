<?php
session_start();
if(isset($_SESSION['LoginStaff']))
        {
            $username = $_SESSION['LoginStaff'];
        }
        else
        {
            header('Location: index.php');
        }
        $conn = mysqli_connect("localhost","root","","cms");
        $qry="SELECT * from staff where id='$username' and status='available'";
        $res=mysqli_query($conn,$qry);
        $row = mysqli_fetch_assoc($res);
        $name=$row['name'];
        $course=$row['depart'];
       
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Feedback Form</title>
    <style type="text/css">
 body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background:url("backgrounds/feedback.jpg");
      background-size: cover;   

        }
h1 {
    text-align: center;
    color: #333;
}

form {
    width: 30%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    height: 480px;
    opacity:0.9;
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
input[type="reset"]{
    background-color:red;
}

input[type="reset"]  {
    position: relative;
    left: 110px;
    }
    input[type="submit"]:hover {
    background-color: #006400;
}
input[type="reset"]:hover {
    background-color: #8B0000;
}
.btn{
    float: right;
    background-color: blue;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}
.btn:hover {
    background-color: #000080;
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
        <label>Staff id:</label>
        <input type="text"  name="id" value="<?php echo $username; ?>" readonly><br><br>
        <label>Name:</label>
        <input type="text"  name="name" value="<?php echo $name; ?>"readonly><br><br>
         <label>Department:</label>
        <input type="text"  name="depart" value="<?php echo $course; ?>" readonly><br><br>
        <label>Feedback:</label><br>
        <textarea id="feedback" name="feedback" rows="5" cols="50" required></textarea><br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" value="Clear" style="float:center;">
        <a href='stf_feedback.php' class='btn'>Back</a>
    </form>
</body>
</html>




<?php
 
 
    if(isset($_POST['submit'])) {
    


    $conn = mysqli_connect("localhost","root","","cms");
   
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $course = $_POST['depart'];
    $date = date('Y-m-d');
    $feedback = $_POST['feedback'];
    $type="staff";

    
    $sql = "INSERT INTO feedback (id,date,feedback,type) VALUES ('$id','$date','$feedback','$type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Feedback submitted successfully');</script>";
        echo "<script>window.location.href='stf_feedback.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>window.location.href='staff_dsh.php';</script>";
    }

    
    mysqli_close($conn);
    }
?>
