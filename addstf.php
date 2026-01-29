<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$read = "SELECT * FROM staff ORDER BY id DESC LIMIT 1";
$result = mysqli_query($con, $read);

if ($result) {
    $fetch = mysqli_fetch_assoc($result);
    $lastroll = $fetch['id'];

    if ($lastroll == null) {
        $newroll = "STAF230001";
    } else {
        $newroll = str_replace("STAF23", "", $lastroll);
        $newroll = str_pad($newroll + 1, 4, 0, STR_PAD_LEFT);
        $newroll = "STAF23" . $newroll;
    }
} else {
    echo "<script>alert('No record found');</script>";
    echo "<script>window.location.href='addstd.php';</script>";
    exit;
}



if (isset($_POST['submit'])) {
    $filename = $_FILES["fileupload"]["name"];
    $tmpname = $_FILES["fileupload"]["tmp_name"];
    $folder = "images/" . $filename;
    move_uploaded_file($tmpname, $folder);

    $id = $_POST['id'];
    $name = $_POST['name'];
    $eid = $_POST['eid'];
    $qual = strtoupper($_POST['qual']);
    $db = $_POST['db'];
    $gn = $_POST['gn'];
    $num = $_POST['num'];
	$dep=strtoupper($_POST['depart']);
    $adr = $_POST['adr'];
    $pass = $_POST['pass'];
 	$status="available";
    $type = "staff";

    $emailCheckQuery = "SELECT * FROM staff WHERE email='$eid'";
    $emailCheckResult = $con->query($emailCheckQuery);
    if($emailCheckResult->num_rows != 0){
        echo"<script>alert('Email already exists');</script>";
        echo "<script>window.location.href='addstf.php';</script>";
        exit;
    }

    $phoneCheckQuery = "SELECT * FROM staff WHERE phone='$num'";
    $phoneCheckResult = $con->query($phoneCheckQuery);
    if($phoneCheckResult->num_rows != 0){
        echo"<script>alert('Phone number already exists');</script>";
        echo "<script>window.location.href='addstf.php';</script>";
        exit;
    }
        
            $sql = "INSERT INTO staff(id,name,image,gender,dob,email,qual,depart,phone,address,pass,status) 
                VALUES('$id','$name','$folder','$gn','$db','$eid','$qual','$dep','$num','$adr','$pass','$status')";
            $res = $con->query($sql);
            $qry = "INSERT INTO login(type,id,pass) VALUES('$type','$id','$pass')";
            $res1 = $con->query($qry);
            if ($res) {
                echo "<script>alert('staff details successfully Inserted.');</script>";
                echo "<script>window.location.href='admin_Staff.php';</script>";
            } else {
                echo "<script>alert('Failed.');window.location.href='addstf.php';</script>";
            }
        } 
    

?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            background-image: url("backgrounds/addstafback.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        form {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            height: 670px;
            opacity:0.9;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="file"] {
            width: 100%;
            margin-bottom: 18px;
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
            float: left;
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
            float: right;
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

        .password-container {
            position: relative;
        }

        .password-container input[type="password"] {
            padding-right: 30px;
        }

        .password-container .show-password-icon {
            position: absolute;
            top: 35%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Staff Registration Form</h1>
        <div class="container">
            <div class="left">
                <label>ID:</label>
                <input type="text" name="id" value="<?php echo $newroll; ?>" readonly><br><br>

                <label>Profile Image:</label>
                <input type="file" name="fileupload" accept="image/jpg" required>

                <label>Mobile:</label>
                <input type="number" min="1000000000" max="9999999999" name="num" autocomplete="off" required><br><br>
            </div>
            <div class="right">
                <label>Name:</label>
                <input type="text" name="name" autocomplete="off" autofocus required pattern="[A-Za-z\s]+" required title='name should contain alphanbets only'><br><br>
 

                <label>Gender:</label>
                <input type="radio" value="Male" name="gn" required>Male 
                <input type="radio" value="Female" name="gn" required>Female
                <input type="radio" value="Other" name="gn" required>Other<br><br>
                

                <label>Date of birth:</label>
                <input type="date" name="db" id="myDate" required><br><br>
            </div>

            <label>Address:</label>
            <textarea name="adr" autocomplete="off" required></textarea><br><br> 
            
            
            <div class="left">
                <label>Email:</label>
                <input type="email" name="eid" autocomplete="off" required><br><br>

                <label>Qualification:</label>
                <input type="text" name="qual" autocomplete="off" required><br><br>
            </div>
            <div class="right">
                <label>Department:</label>
                <select name="depart" style="width: 100%;">
                    <?php
                        $c = 0;
                        $qry = "SELECT * from course where status='available'";
                        $res = $con->query($qry);
                        $nob = $res->num_rows;
                        while ($c < $nob) {
                            $row = $res->fetch_assoc();
                            echo "<option>" . $row['cname'] . "</option>";
                            $c = $c + 1;
                        }
                    ?>
                </select><br><br>
                <label>Password:</label>
                <div class="password-container">
                    <input type="password" name="pass" value="<?php echo $newroll; ?>" readonly required>
                    <span class="show-password-icon" onclick="togglePasswordVisibility()">&#128065;</span>
                </div>
            </div>
        </div>
        <div class="buttons">    
            <input type="submit" name="submit" value="Submit">
            <a href="admin_Staff.php">Back</a>    
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

        function togglePasswordVisibility() {
            var passwordInput = document.querySelector("input[name='pass']");
            var showPasswordIcon = document.querySelector(".show-password-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordIcon.innerHTML = "&#128064;"; 
            } else {
                passwordInput.type = "password";
                showPasswordIcon.innerHTML = "&#128065;"; 
            }
        }
    </script>
</body>
</html>
