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
$qry="SELECT * from staff where id='$username'";
$res=mysqli_query($conn,$qry);
$row = mysqli_fetch_assoc($res);
$name=$row['name'];
$avail_leave=$row['total_leave'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Staff Leave Management</title>
  <style>
         body {
            font-family: Arial, sans-serif;
            background:url("backgrounds/leave.jpg");
      background-repeat: no-repeat;
            overflow: hidden;
            background-size: cover;
            height: 100vh;

        }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      height: 650px;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      opacity: 0.8;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 30%;
      background-color: #4CAF50;
      color: white;
      height: 40px;
      border: none;
      padding: 10px;
      float: right;
      cursor: pointer;
      left: 8px;
      position: relative;
      border-radius: 5px;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color: #006400;
    }

    .logout-btn a {
      text-decoration: none;
      color: white;
    }
    textarea{
      height: 80px;
      width: 100%;
      resize: none;
    }
    a{
      float: left;
      width: 80px;
        height: 20px;
        background-color: blue;
        text-align: center;
        text-decoration: none;
        padding: 10px;
        color: white;
        border-radius: 5px;
        display: inline-block;
        
        
    }
    .btn:hover{
      background-color: #000080;
    }
  </style>
</head>
<body>
  
  <form action="process_leave.php" method="post">
    <h2>Apply for Leave</h2>
    <label for="avail_leave">Available Leave:</label>
    <input type="text" name="avail_leave" value="<?php echo $avail_leave; ?>" readonly><br>
    <label for="id">Staff ID:</label>
    <input type="text" name="id" value="<?php echo $username; ?>" readonly><br>
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>" readonly><br>
    <label for="leave_type">Leave Type:</label>
    <select name="leave_type" required>
      <option value="annual">Annual Leave</option>
      <option value="sick">Sick Leave</option>
      <option value="personal">Personal Leave</option>
      <option value="Bereavement Leave">Bereavement Leave</option>
      <option value="Maternity">Maternity Leave</option>
    </select><br>
    <label for="date">Date:</label>
    <input type="date" name="date" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+1 week')); ?>"><br>
    <label for="num_days">Number of Days:</label>
    <input type="number" name="num_days" required><br>
    <label for="reason">Reason:</label>
    <textarea name="reason" required></textarea>
    
    <input type="submit" value="Apply">
    <a href='stf_leave.php' class='btn'>Back</a>
  </form>
  
  
    
 
</body>
</html>
