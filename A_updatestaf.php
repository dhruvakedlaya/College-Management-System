<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['upt'];
$sql = "SELECT * FROM staff WHERE id='$id'";
$rt = $con->query($sql);
$r = mysqli_fetch_assoc($rt);
$sn = $r['name'];
$db = $r['dob'];
$eid = $r['email'];
$qual = $r['qual'];
$depart = $r['depart'];
$ad = $r['address'];
$phone = $r['phone'];
$pass = $r['pass'];

if (isset($_POST['submit'])) {
    $name = $_POST['na'];
    $mb = $_POST['mb'];
    $ql = strtoupper($_POST['qual']);
    $dep = $_POST['depart'];
    $adr = $_POST['adr'];
    $dob = $_POST['db'];
    $ps = $_POST['ps'];
    $cps = $_POST['cps'];
    $email = $_POST['ed'];

   
    $studentCheckQuery = "SELECT * FROM student WHERE (phone='$mb' OR email='$email') AND id != '$id'";
    $studentCheckResult = $con->query($studentCheckQuery);
    if ($studentCheckResult->num_rows > 0) {
        echo "<script>alert('Phone number or email already exists in the student table.');</script>";
    } else {
       
        $staffCheckQuery = "SELECT * FROM staff WHERE (phone='$mb' OR email='$email') AND id != '$id'";
        $staffCheckResult = $con->query($staffCheckQuery);
        if ($staffCheckResult->num_rows > 0) {
            echo "<script>alert('Phone number or email already exists in the staff table.');</script>";
        } else {
            if ($sn == $name && $db == $dob && $eid == $email && $qual == $ql && $depart == $dep && $pass == $ps && $ad == $adr && $phone == $mb) {
                echo "<script>alert('No changes were made');</script>";
                echo '<script>window.location.href="viewstf.php";</script>';
            } else {
                if ($ps == $cps) {
                    $uqry = "UPDATE staff SET name='$name', dob='$dob', email='$email', phone='$mb', address='$adr', qual='$ql', depart='$dep', pass='$ps' WHERE id='$id'";
                    $rlt = $con->query($uqry);
                    $lgqry="UPDATE login set pass='$ps' where id='$id'";
                    $res=$con->query($lgqry);
                    if ($rlt&&$res) {
                        echo "<script>alert('staf details Updated successfully');</script>";
                        echo '<script>window.location.href="viewstf.php";</script>';
                    } else {
                        die(mysqli_error(($con)));
                    }
                } else {
                    echo "<b><center><h3>Password mismatch</h3></center></b>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Update Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            background-image: url(1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        form {
            background-color: #fff;
            top: 70px;
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            height: 550px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

       

        input[type="number"],
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        textarea {
            resize: none;
            height: 100px; /* Adjust the desired height */
            overflow-y: scroll;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            width: 90px;
            text-align: center;
            display: inline-block;
            float: right;
        }

        a {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            float: left;
        }

        .error {
            color: red;
            font-style: italic;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .container {
            height: auto;
        }

        .container::after {
            content: "";
            display: table;
            clear: both;
        }

        .left {
            width: 45%;
            float: left;
        }

        .right {
            width: 45%;
            float: right;
        }

    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Staff Update Form</h1>
        <div class="container">
            <div class="left">
           <label>Staff Name</label>
                <input type="text" placeholder="Enter staff name" name="na" value="<?php echo $sn;?>" autocomplete="off" pattern="[A-Za-z]+" title="Name should contain alphabets" required />
                <label>Department</label>
<select name="depart" required>
    <option value="">Select Department</option>
    <?php
    $courseQuery = "SELECT * FROM course";
    $courseResult = $con->query($courseQuery);

    while ($row = mysqli_fetch_assoc($courseResult)) {
        $courseName = $row['cname'];
        $selected = ($depart === $courseName) ? 'selected' : '';
        echo "<option value='$courseName' $selected>$courseName</option>";
    }
    ?>
</select>


                <label>Date Of Birth</label>
                <input type="date" class="dob" placeholder="Enter Birth Date" id="myDate" value="<?php echo $db;?>" required name="db"/>
            </div>
            <div class="right">
                 <label>Email</label>
                <input type="email" placeholder="Enter Email" value="<?php echo $eid;?>" required name="ed"/> 

                <label>Qualification</label>
                <input type="text" placeholder="Enter Qualification" value="<?php echo $qual;?>" required name="qual"/>

                <label>Mobile Number</label>
                <input type="number" placeholder="Enter mobile number" required min="1000000000" max="9999999999" value="<?php echo $phone;?>" name="mb"/>

            </div>

            <label>Address:</label>
            <textarea name="adr" autocomplete="off" required><?php echo $ad;?></textarea><br><br>
 
            <div class="left">
               <label>Enter new password</label>
                <input type="password" placeholder="Enter password" value="<?php echo $pass;?>" name="ps" required/>
            </div>
            <div class="right">
                
                <label>Confirm password</label>
                
                <input type="password" placeholder="Confirm password" value="<?php echo $pass;?>" name="cps" required/>

            </div>
        </div>
        <div class="buttons">    
        <a href="viewstf.php">Back</a>   
            <input type="submit" name="submit" value="Submit">
            
        </div>
    </form>
    <script>
        var currentDate = new Date();
        var minDate = new Date();
        minDate.setFullYear(currentDate.getFullYear() - 100);
        var maxDate = new Date();
        maxDate.setFullYear(currentDate.getFullYear() - 20);
        var minDateString = minDate.toISOString().split('T')[0];
        var maxDateString = maxDate.toISOString().split('T')[0];

        window.onload = function() {
            document.getElementById("myDate").setAttribute("min", minDateString);
            document.getElementById("myDate").setAttribute("max", maxDateString);
        };
    </script>
</body>
</html>
