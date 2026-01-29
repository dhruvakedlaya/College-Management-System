<?php
    if(isset($_POST['submit'])) {
    


    $conn = mysqli_connect("localhost","root","","cms");
  
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

 
    $id = $_POST['ida'];
    $name = $_POST['name'];
    $dept = $_POST['deptr'];
    $date = date('Y-m-d');
    $feedback = $_POST['feedback'];
    $type="staff";

    // insert the feedback into the database
    $sql = "INSERT INTO feedback (id, name, dept, date,feedback , type) VALUES ('$id','$name', '$dept','$date','$feedback','$type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Feedback submitted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  
    mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>College Feedback Form</title>
    <style type="text/css">
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
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
    background-color: #45a049;
}

    </style>
</head>
<body>
    <h1>College Feedback Form</h1>
    <form method="POST">
        <label>Id:</label>
        <input type="number" id="id" name="ida" required><br><br>
        <label>Name:</label>
        <input type="text" id="name" name="name" required><br><br>
         <label>Department:</label>
        <input type="text" id="dept" name="deptr" required><br><br>
        <label>Feedback:</label><br>
        <textarea  name="feedback" rows="5" cols="50" required></textarea><br><br>
        <input type="submit" name="submit" value="submit">
        <input type="reset" value="Clear" style="float:right;">
    </form>
</body>
</html>






