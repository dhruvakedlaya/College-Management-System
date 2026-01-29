<!DOCTYPE html>
<html>
<head>
    <title>Notice System</title>
    <style type="text/css">
        body{
            background:url("backgrounds/notice.jpg");
      background-size: cover;   

        }
        .container {
            width: 500px;
            margin: auto;
            padding: 20px;
            text-align: center;
            background-color: #f2f2f2;
            border-radius: 5px;
            top: 150px;
            height: 340px;
            position: relative;
        }
        
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        textarea {
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
            font-size: 16px;
            resize: none;
        }
        
        input[type=submit],
        input[type=reset],
        a {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            margin-left: 10px;
            float: left;
        }
        input[type=reset]{
            background-color: red;            
            left: 70px;
            position: relative;
            color: white;
            width: 100px;

        }
        a{
            background-color: blue;
            float: right;
            width: 90px;
        }
        input[type=submit]:hover,
        
        a:hover {
            background-color: #3e8e41;
        }
        input[type=reset]:hover{
            background-color: darkred;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notice</h1>
        <form method="POST">
            <label>Enter Notice:</label><br>
            <textarea name="notice" rows="10" cols="50" required></textarea><br>
            <input type="submit" name="submit" value="Send Notice">
            <input type="reset" name="clear" value="Clear">
            <a href="admin_notice.html">Back</a>
        </form>
    </div>
</body>
</html>
<?php
if (!empty($_POST)) {
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $notice = $_POST['notice'];
    $date = date('Y-m-d');
    if (!empty($notice)) {
        $sql = "INSERT INTO notice (notice, date) VALUES ('$notice', '$date')";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Notice sent successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    mysqli_close($con);
}
?>
